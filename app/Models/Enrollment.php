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

    protected $table = 'enrollments'; // optional, but recommended for consistency

    protected $primaryKey = 'enroll_id'; // adjust if your table uses a custom PK

    public $timestamps = false; // disable if your table doesn’t use created_at/updated_at

    protected $fillable = [
        'subject_id',
        'schoolyear_id',
        'user_id',
    ];

    // 🔗 Relationships

    /**
     * Each enrollment belongs to one user (student)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function registration()
{
    return $this->belongsTo(Registration::class, 'user_id', 'id');
}

    /**
     * Each enrollment belongs to one subject
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'subject_id');
    }

    /**
     * Each enrollment belongs to one school year
     */
    public function schoolyear()
    {
        return $this->belongsTo(Schoolyear::class, 'schoolyear_id', 'schoolyear_id');
    }
}
