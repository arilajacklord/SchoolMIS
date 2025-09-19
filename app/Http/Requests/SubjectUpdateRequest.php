<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array|string>
     */
    public function rules(): array
    {
        return [
            'subject_id' => 'required',
            'course_code' => 'required',
             'descriptive_title' => 'required',
              'led_units' => 'required',
               'lab_units' => 'required',
                'total_units' => 'required',
                 'co_requisite' => 'required',
                  'pre_requisite' => 'required',
          
        ];
    }
}