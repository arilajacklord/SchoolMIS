<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Subject;
use App\Models\Schoolyear;

class Enrollment extends Model
{


    use HasFactory;

    protected $primaryKey = 'enroll_id';

    protected $fillable = [
        'subject_id',
        'schoolyear_id',
        'user_id'
    ];

    // An enrollment belongs to one subject
    // Enrollment.php

public function user()
{
    return $this->belongsTo(User::class); // defaults to 'user_id' foreign key
    
}

public function subject()
{
    return $this->belongsTo(Subject::class); // defaults to 'subject_id'
}

public function schoolyear()
{
    return $this->belongsTo(Schoolyear::class); // defaults to 'schoolyear_id'
}

public function invoices()
{
    return $this->hasMany(Invoice::class, 'enroll_id', 'enroll_id');
}
    
}