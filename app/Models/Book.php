<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $primaryKey = 'book_id';
    protected $fillable = [
        'title',
        'author',
        'date_pub',
        'date_purchased',
    ];

    public function borrows()
    {
        return $this->hasMany(Borrow::class, 'book_id', 'book_id');
    }

    // Automatically compute the status
    public function getStatusAttribute()
    {
        $latestBorrow = $this->borrows()->latest()->first();
        if ($latestBorrow && $latestBorrow->date_returned === null) {
            return 'Checked Out';
        }
        return 'Available';
    }
}
