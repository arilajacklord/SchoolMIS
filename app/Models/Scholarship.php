<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    use HasFactory;
    protected $table = 'scholarships';
    protected $primaryKey = 'scholar_id';   // important!
    public $incrementing = true;
    protected $keyType = 'int';


    protected $fillable = [
        'name',
        'description',
        'amount',
    ]; 
    
   public function invoices()
{
    return $this->hasMany(Invoice::class, 'scholar_id');
}
    
}
