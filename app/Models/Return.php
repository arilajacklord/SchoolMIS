<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ReturnModel extends Model
{
    use HasFactory;

    protected $table = 'returns';   // optional if default
    protected $primaryKey = 'return_id';
    protected  $fillable = [
        'return_id',
        'borrow_id',
        'user_id',
        'book_id',
        'date_returned',
    ];
}