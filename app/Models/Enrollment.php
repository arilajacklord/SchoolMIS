<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
 {
    use HasFactory;

    protected $table = 'enrollments';
    protected $primaryKey = 'enroll_id';
    protected $fillable = ['user_id', 'subject_id', 'schoolyear_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'subject_id');
    }

    public function schoolyear()
    {
        return $this->belongsTo(Schoolyear::class, 'schoolyear_id', 'schoolyear_id');
     }
}
