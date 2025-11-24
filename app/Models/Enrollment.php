<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $table = 'enrollments';
    protected $primaryKey = 'enroll_id';
    public $timestamps = true;

    protected $fillable = [
        'subject_id', 'schoolyear_id', 'user_id'
    ];

    /**
     * ✅ Link to Registration instead of User
     */
    public function Registration()
    {
        return $this->belongsTo(Registration::class, 'user_id', 'user_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
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
        return $this->belongsTo(Grade::class);
     }
   
   
}
