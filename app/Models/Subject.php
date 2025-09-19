<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

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
}