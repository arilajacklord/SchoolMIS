<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';
    protected $primaryKey = 'subject_id';
    public $timestamps = false; // Optional, if your table doesn't have created_at/updated_at

    protected $fillable = [
        'course_code',
        'descriptive_title',
        'led_units',
        'lab_units',
        'total_units',
        'co_requisite',
        'pre_requisite',
    ];
    

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'subject_id');
    }
    public function user(){
        
    }
}