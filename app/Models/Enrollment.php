<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Subject;
use App\Models\Schoolyear;

class Enrollment extends Model
{

      protected $primaryKey = 'enroll_id';

    use HasFactory;

    protected $fillable = [
        'subject_id',
        'schoolyear_id',
        'user_id'
    ];

    // An enrollment belongs to one subject
    // Enrollment.php

public function subject()
{
    return $this->belongsTo(Subject::class, 'subject_id', 'subject_id');
}

public function schoolyear()
{
    return $this->belongsTo(Schoolyear::class, 'schoolyear_id', 'schoolyear_id');
}

public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}


}
    