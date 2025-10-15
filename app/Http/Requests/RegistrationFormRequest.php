<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class RegistrationFormRequest extends FormRequest
{
    /**
     * Common rules for student and parent fields
     */
    protected function baseRules(): array
    {
        return [
            'user_id'              => ['required', 'integer', 'min:1', 'max:100'],
            'student_name'        => ['required', 'string', 'max:255'],
            'course_level'        => ['required', 'string', 'max:100'],
            'student_address'     => ['required', 'string', 'max:255'],
            'student_phone_num'       => ['required', 'string', 'max:20'],
            'student_status'      => ['required', 'string', 'max:50'],
            'student_citizenship' => ['required', 'string', 'max:100'],
            'student_birthdate'   => ['required', 'date', 'before:today'],
            'student_religion'    => ['required', 'string', 'max:100'],
            'student_age'         => ['required', 'integer', 'min:1', 'max:120'],

            // Father
            'father_Fname'        => ['nullable', 'string', 'max:100'],
            'father_Mname'        => ['nullable', 'string', 'max:100'],
            'father_Lname'        => ['nullable', 'string', 'max:100'],
            'father_address'      => ['nullable', 'string', 'max:255'],
            'father_cell_no'      => ['nullable', 'string', 'max:20'],
            'father_age'          => ['nullable', 'integer', 'min:18', 'max:120'],
            'father_religion'     => ['nullable', 'string', 'max:100'],
            'father_birthdate'    => ['nullable', 'date', 'before:today'],
            'father_profession'   => ['nullable', 'string', 'max:150'],
            'father_occupation'   => ['nullable', 'string', 'max:150'],

            // Mother
            'mother_Fname'        => ['nullable', 'string', 'max:100'],
            'mother_Mname'        => ['nullable', 'string', 'max:100'],
            'mother_Lname'        => ['nullable', 'string', 'max:100'],
            'mother_address'      => ['nullable', 'string', 'max:255'],
            'mother_cell_no'      => ['nullable', 'string', 'max:20'],
            'mother_age'          => ['nullable', 'integer', 'min:18', 'max:120'],
            'mother_religion'     => ['nullable', 'string', 'max:100'],
            'mother_birthdate'    => ['nullable', 'date', 'before:today'],
            'mother_profession'   => ['nullable', 'string', 'max:150'],
            'mother_occupation'   => ['nullable', 'string', 'max:150'],
        ];
    }

    /**
     * All children requests must authorize
     */
    public function authorize(): bool
    {
        return true;
    }
}
