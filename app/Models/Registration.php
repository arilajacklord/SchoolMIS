<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'registration';

    // Primary key
    protected $primaryKey = 'id';

    // Enable timestamps since your migration uses them
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'student_name',
        'course_level',
        'student_address',
        'student_phone_num',
        'student_status',
        'student_citizenship',
        'student_birthdate',
        'student_religion',
        'student_age',
        'father_Fname',
        'father_Mname',
        'father_Lname',
        'father_address',
        'father_cell_no',
        'father_age',
        'father_religion',
        'father_birthdate',
        'father_profession',
        'father_occupation',
        'mother_Fname',
        'mother_Mname',
        'mother_Lname',
        'mother_address',
        'mother_cell_no',
        'mother_age',
        'mother_religion',
        'mother_birthdate',
        'mother_profession',
        'mother_occupation',
    ];

    /**
     * Relationship to the User model.
     * `user_id` references `users.id`
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Relationship to enrollments.
     * A registration can have multiple enrollments.
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'user_id', 'user_id');
    }

    /**
     * Optional: Relationship to grades through enrollments
     */
    public function grades()
    {
        return $this->hasManyThrough(
            Grade::class,
            Enrollment::class,
            'user_id',      // Foreign key on enrollments table
            'enroll_id',    // Foreign key on grades table
            'user_id',      // Local key on registration table
            'enroll_id'     // Local key on enrollment table
        );
    }
}
