<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnrollmentUpdateRequest extends FormRequest
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
             'subject_id' => ['required', 'exists:subjects,subject_id'],
        'schoolyear_id' => ['required', 'exists:schoolyears,schoolyear_id'],
        'user_id' => ['required', 'exists:users,id'],
        ];
    }
}