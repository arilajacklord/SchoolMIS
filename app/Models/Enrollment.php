<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Registration;
use App\Models\Subject;
use App\Models\Schoolyear;
use App\Models\Grade;

class Enrollment extends Model
{


    use HasFactory;

    protected $table = 'enrollments';
    protected $primaryKey = 'enroll_id';

    protected $fillable = [
        'user_id',
        'subject_id',
        'schoolyear_id',
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class, 'user_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'subject_id');
    }

    public function schoolyear()
    {
        return $this->belongsTo(Schoolyear::class, 'schoolyear_id', 'schoolyear_id');
    }

    public function grade()
    {
        return $this->hasOne(Grade::class, 'enroll_id', 'enroll_id');
    }
}
