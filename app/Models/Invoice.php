<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $primaryKey = 'id'; // default is "id", change if you use "invoice_id"
    
    protected $fillable = [
        'enroll_id',
        'amount',
        'status',
        'insurance',
        'sanitation',
        'balance',
        'due_date',
    ];

    /**
     * An invoice belongs to an enrollment.
     */
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'enroll_id', 'enrollment_id');
    }

    /**
     * An invoice can have many payments.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'invoice_id');
    }
}

