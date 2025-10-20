<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Enrollment;

class Subject extends Model
{
    use HasFactory;

    protected $table="subjects";
    protected $fillable = [
        'subject_id',
        'course_code',
         'descriptive_title',
          'led_units',
           'lab_units',
            'total_units',
             'co_requisite',
              'pre_requisite',
        

    ];
    protected $primaryKey = 'subject_id';
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'subject_id');
    }

    public function getRouteKeyName()
{
    return 'subject_id';
}

}