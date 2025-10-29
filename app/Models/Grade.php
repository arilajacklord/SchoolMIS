<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grades';
    protected $primaryKey = 'grade_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'enroll_id',
        'prelim',
        'midterm',
        'semifinal',
        'final',
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'enroll_id', 'enroll_id');
    }
}
