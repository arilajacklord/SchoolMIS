<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $primaryKey = 'invoice_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'enroll_id',
        'scholar_id',      // selected scholarship from dropdown
        'amount',
        'status',
        'insurance',
        'sanitation',
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
     * Relationship: Invoice belongs to Scholarship
     */
    public function scholar()
    {
        return $this->belongsTo(Scholarship::class, 'scholar_id', 'scholar_id');
    }

    /**
     * Automatically calculate balance and status before saving
     */
    protected static function booted()
    {
        static::saving(function ($invoice) {
            // Prevent negative balances
            if ($invoice->balance < 0) {
                $invoice->balance = 0;
            }

            // Add optional fees
            $extraCharges = ($invoice->insurance ?? 0) + ($invoice->sanitation ?? 0);

            // Scholarship amount (from relationship)
            $scholarshipAmount = $invoice->scholar ? ($invoice->scholar->amount ?? 0) : 0;

            // Total invoice amount including fees
            $totalAmountWithExtras = ($invoice->amount ?? 0) + $extraCharges;

            // Total paid by the student
            $totalPayments = $invoice->payments->sum('total_amount') ?? 0;

            // Compute new balance
            $invoice->balance = max($totalAmountWithExtras - ($scholarshipAmount + $totalPayments), 0);

            // Update status automatically
            if ($totalPayments == 0 && $invoice->balance == $totalAmountWithExtras) {
                $invoice->status = 'Unpaid';
            } elseif ($invoice->balance > 0) {
                $invoice->status = 'Partial';
            } else {
                $invoice->status = 'Paid';
            }
        });
    }

    /**
     * Get total payable amount considering scholarship
     */
    public function totalAmount()
    {
        $scholarshipAmount = $this->scholar ? ($this->scholar->amount ?? 0) : 0;

        return ($this->amount ?? 0)
            + ($this->insurance ?? 0)
            + ($this->sanitation ?? 0)
            - $scholarshipAmount;
    }

    /**
     * Recalculate balance after payment or scholarship update
     */
    public function updateBalance()
    {
        $totalPaid = $this->payments()->sum('total_amount');
        $scholarshipAmount = $this->scholar ? ($this->scholar->amount ?? 0) : 0;
        $totalAmountWithExtras = ($this->amount ?? 0) + ($this->insurance ?? 0) + ($this->sanitation ?? 0);

        $this->balance = max($totalAmountWithExtras - ($scholarshipAmount + $totalPaid), 0);

        if ($totalPaid == 0 && $this->balance == $totalAmountWithExtras) {
            $this->status = 'Unpaid';
        } elseif ($this->balance > 0) {
            $this->status = 'Partial';
        } else {
            $this->status = 'Paid';
        }

        $this->save();
    }
}
