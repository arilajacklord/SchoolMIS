<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $table = 'books';   // optional if default
    protected $primaryKey = 'book_id';


    protected $fillable = [

        'author',
        'title',
        'date_pub',
        'status',
        'date_purchased	',
    ];
}
