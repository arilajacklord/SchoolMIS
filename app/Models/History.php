<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $primaryKey = 'history_id';
    protected $table = 'history'; // Ensure this matches your DB table name

    protected $fillable = [
        'action',
        'user_id',
        'book_id',
        'date_borrowed',
        'date_returned',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
