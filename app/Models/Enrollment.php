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
        'subject_id', 
        'schoolyear_id', 
        'user_id'
    ];

    /**
     * User relationship
     * Needed because InvoiceController calls: enrollment.user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Registration = optional mapping via user_id
     */
    public function Registration()
    {
        return $this->belongsTo(Registration::class, 'user_id', 'user_id');
    }
    

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'subject_id');
    }

    public function schoolyear()
    {
        return $this->belongsTo(Schoolyear::class, 'schoolyear_id', 'schoolyear_id');
     }

     public function grades() {
    return $this->hasOne(Grade::class, 'enroll_id', 'enroll_id');
}


}
