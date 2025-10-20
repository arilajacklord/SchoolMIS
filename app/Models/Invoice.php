<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $primaryKey = 'invoice_id';   // important!
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'enroll_id',
        'amount',
        'status',
        'insurance',
        'sanitation',
        'scholarship',
        'balance',
        'due_date',
    ];

    /**
     * Relationship: Invoice belongs to Enrollment
     */
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'enroll_id', 'enroll_id');
    }

    /**
     * Relationship: Invoice has many Payments
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'invoice_id', 'invoice_id');
    }

    /**
     * Booted method to automatically update status
     */
    protected static function booted()
{
    static::saving(function ($invoice) {
        // Ensure balance is never negative
        if ($invoice->balance < 0) {
            $invoice->balance = 0;
        }

        // Total extra charges
        $extraCharges = ($invoice->insurance ?? 0) + ($invoice->sanitation ?? 0);

        // Total amount including extra charges
        $totalAmountWithExtras = $invoice->amount + $extraCharges;

        // Total deductions: scholarship + payments
        $totalDeductions = ($invoice->scholarship ?? 0) + ($invoice->payments->sum('total_amount') ?? 0);

        // Calculate current balance
        $invoice->balance = $totalAmountWithExtras - $totalDeductions;

        // Determine status
        if ($totalDeductions == 0) {
            $invoice->status = 'Unpaid';
        } elseif ($invoice->balance > 0) {
            $invoice->status = 'Partial';
        } else {
            $invoice->status = 'Paid';
        }
    });
}


    /**
     * Calculate total invoice amount including optional fields
     */
    public function totalAmount()
    {
        return ($this->amount ?? 0)
            + ($this->insurance ?? 0)
            + ($this->sanitation ?? 0)
            - ($this->scholarship ?? 0);
    }

    /**
     * Recalculate the balance based on all payments
     */
    public function updateBalance()
    {
        $totalPaid = $this->payments()->sum('total_amount');

        // Calculate full invoice total
        $fullAmount = $this->totalAmount();

        // Update balance and save
        $this->balance = max($fullAmount - $totalPaid, 0);
        $this->save();
    }
}
