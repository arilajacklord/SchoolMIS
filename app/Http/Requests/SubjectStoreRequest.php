<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'subject_id'        => 'required|unique:subjects,subject_id',
            'course_code'       => 'required|string|max:10',
            'descriptive_title' => 'required|string|max:255',
            'lec_units'         => 'required|numeric|min:0',
            'lab_units'         => 'required|numeric|min:0',
            'co_requisite'      => 'nullable|string|max:255',
            'pre_requisite'     => 'nullable|string|max:255',
        ];
    }

    /**
     * Prepare the data for validation.
     * Automatically calculate total_units.
     */
    protected function prepareForValidation()
    {
        if ($this->has('lec_units') && $this->has('lab_units')) {
            $this->merge([
                'total_units' => $this->input('lec_units') + $this->input('lab_units'),
            ]);
        }
    }
}
        