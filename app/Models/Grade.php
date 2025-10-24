<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Subject;
use App\Models\Schoolyear;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grades';
    protected $primaryKey = 'grade_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true; // if you have created_at & updated_at in DB

    protected $fillable = [
        'enroll_id',
        'prelim',
        'midterm',
        'semifinal',
        'final',
    ];

    /**
     * 🔗 Relationship: Each grade belongs to one enrollment
     */
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'enroll_id', 'enroll_id');
    }

    /**
     * 🔗 Shortcut relationship: Access student (user) through enrollment
     */
    public function registration()
    {
        return $this->hasOneThrough(
            Registration::class,
            Enrollment::class,
            'enroll_id',   // Foreign key on enrollments table
            'user_id',     // Foreign key on users table
            'enroll_id',   // Local key on grades table
            'user_id'      // Local key on enrollments table
        );
    }

    /**
     * 🔗 Shortcut relationship: Access subject through enrollment
     */
    public function subject()
    {
        return $this->hasOneThrough(
            Subject::class,
            Enrollment::class,
            'enroll_id',
            'subject_id',
            'enroll_id',
            'subject_id'
        );
    }

    /**
     * 🔗 Shortcut relationship: Access school year through enrollment
     */
    public function schoolyear()
    {
        return $this->hasOneThrough(
            Schoolyear::class,
            Enrollment::class,
            'enroll_id',
            'schoolyear_id',
            'enroll_id',
            'schoolyear_id'
        );
    }
}
