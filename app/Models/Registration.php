<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    // 👇 Tell Laravel the exact table name
    protected $table = 'registration';

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


