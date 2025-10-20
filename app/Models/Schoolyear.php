<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schoolyear extends Model
{
    use HasFactory;

    protected $table = 'schoolyears'; // optional, if your table is named exactly "schoolyears"
    protected $primaryKey = 'schoolyear_id';
    public $timestamps = false; // add this if your table has no created_at/updated_at columns

    protected $fillable = [
        'schoolyear',
        'semester',
    ];

    // Relationships
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'schoolyear_id', 'schoolyear_id');
    }
}
