<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Enrollment;

class Schoolyear extends Model
{
    use HasFactory;

    protected $fillable = [
        'schoolyear_id',
        'schoolyear',
         'semester',

    ];
    protected $primaryKey = 'schoolyear_id';
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'schoolyear_id', 'schoolyear_id');
    }
}