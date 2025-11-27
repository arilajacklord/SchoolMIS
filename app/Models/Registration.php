<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $table = 'registration';

    protected $primaryKey = 'id';
    public $timestamps = true;

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
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * A registration can have many enrollments
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'user_id', 'user_id');
    }

    /**
     * A registration can access grades through enrollments
     */
    public function grades()
    {
        return $this->hasManyThrough(
            Grade::class,
            Enrollment::class,
            'user_id',
            'enroll_id',
            'user_id',
            'id'
        );
    }

    public function isInfoIncomplete(): bool
{
    return empty($this->student_Fname) ||
       empty($this->student_Mname) ||
       empty($this->student_Lname) ||
       empty($this->course_level) ||
       empty($this->student_address) ||
       empty($this->student_phone_num) ||
       empty($this->student_status) ||
       empty($this->student_citizenship) ||
       empty($this->student_birthdate) ||
       empty($this->student_religion) ||
       empty($this->student_age) ||

       // Father info
       empty($this->father_Fname) ||
       empty($this->father_Mname) ||
       empty($this->father_Lname) ||
       empty($this->father_address) ||
       empty($this->father_cell_no) ||
       empty($this->father_age) ||
       empty($this->father_religion) ||
       empty($this->father_birthdate) ||
       empty($this->father_profession) ||
       empty($this->father_occupation) ||

       // Mother info
       empty($this->mother_Fname) ||
       empty($this->mother_Mname) ||
       empty($this->mother_Lname) ||
       empty($this->mother_address) ||
       empty($this->mother_cell_no) ||
       empty($this->mother_age) ||
       empty($this->mother_religion) ||
       empty($this->mother_birthdate) ||
       empty($this->mother_profession) ||
       empty($this->mother_occupation);

}
}
