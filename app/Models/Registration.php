<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    // Table name (optional if your table is plural: "registrations")
    protected $table = 'registration';

    // Primary key (if not 'id')
    protected $primaryKey = 'registration_id'; // adjust if your table uses this column

    // Disable timestamps if your table doesn’t have created_at / updated_at
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'student_Fname',
        'student_Mname',
        'student_Lname',
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

    // /**
    //  * Optional relationship to the User model.
    //  * If `user_id` references the `users` table.
    //  */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'user_id', 'id');
    }
}
