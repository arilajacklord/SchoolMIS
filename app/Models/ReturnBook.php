<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnBook extends Model
{
    protected $table = 'returns';
    protected $primaryKey = 'return_id';
    protected $fillable = ['borrow_id', 'book_id', 'user_id', 'date_borrowed', 'date_returned'];

    public function book() {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
