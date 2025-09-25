<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $primaryKey = 'id'; // default is "id", change if you use "payment_id"

    protected $fillable = [
        'invoice_id',
        'date',
        'total_amount',
        'paymenttype',
    ];

    /**
     * A payment belongs to an invoice.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
