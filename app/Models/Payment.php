<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Correct primary key
    protected $primaryKey = 'payment_id';

    // If your primary key is auto-incrementing (default is true)
    public $incrementing = true;

    // If your primary key type is integer (default is 'int')
    protected $keyType = 'int';

    // Mass assignable fields
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
