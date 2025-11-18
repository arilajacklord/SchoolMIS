<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';
    protected $primaryKey = 'subject_id';
    public $timestamps = false;

    protected $fillable = [
        'course_code',
        'descriptive_title',
        'lec_units',
        'lab_units',
        'total_units',
        'co_requisite',
        'pre_requisite',
    ];

    // Optional helper to get total units dynamically
    public function getTotalUnitsAttribute()
    {
        return $this->lec_units + $this->lab_units;
    }

    // Relationships
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'subject_id', 'subject_id');
    }
}
