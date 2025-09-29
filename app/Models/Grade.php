<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grades';
    protected $primaryKey = 'grade_id';

    protected $fillable = [
        'user_id',
        'subject_id',
        'schoolyear_id',
        'prelim',
        'midterm',
        'semifinal',
        'final',
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'subject_id');
    }

    public function schoolyear()
    {
        return $this->belongsTo(Schoolyear::class, 'schoolyear_id', 'schoolyear_id');
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'user_id', 'user_id')
            ->where('subject_id', $this->subject_id)
            ->where('schoolyear_id', $this->schoolyear_id);
    }
}
