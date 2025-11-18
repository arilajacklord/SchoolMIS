<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegistrationStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on your auth logic
    }

    public function rules()
    {
        return [
            // User fields
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'], // expects password_confirmation field
            'type'    => ['nullable', 'string','max:255'],

            // Student fields
            'student_Fname'       => ['required', 'string', 'max:255'],
            'student_Mname'       => ['required', 'string', 'max:255'],
            'student_Lname'       => ['required', 'string', 'max:255'],
            'course_level'        => ['nullable', 'string', 'max:100'],
            'student_address'     => ['nullable', 'string', 'max:255'],
            'student_phone_num'   => ['nullable', 'string', 'max:20'],
            'student_status'      => ['nullable', 'string', 'max:50'],
            'student_citizenship' => ['nullable', 'string', 'max:100'],
            'student_birthdate'   => ['nullable', 'date'],
            'student_religion'    => ['nullable', 'string', 'max:50'],
            'student_age'         => ['nullable', 'integer', 'min:0'],

            // Father info
            'father_Fname'      => ['nullable', 'string', 'max:255'],
            'father_Mname'      => ['nullable', 'string', 'max:255'],
            'father_Lname'      => ['nullable', 'string', 'max:255'],
            'father_address'    => ['nullable', 'string', 'max:255'],
            'father_cell_no'    => ['nullable', 'string', 'max:20'],
            'father_age'        => ['nullable', 'integer', 'min:0'],
            'father_religion'   => ['nullable', 'string', 'max:50'],
            'father_birthdate'  => ['nullable', 'date'],
            'father_profession' => ['nullable', 'string', 'max:100'],
            'father_occupation' => ['nullable', 'string', 'max:100'],

            // Mother info
            'mother_Fname'      => ['nullable', 'string', 'max:255'],
            'mother_Mname'      => ['nullable', 'string', 'max:255'],
            'mother_Lname'      => ['nullable', 'string', 'max:255'],
            'mother_address'    => ['nullable', 'string', 'max:255'],
            'mother_cell_no'    => ['nullable', 'string', 'max:20'],
            'mother_age'        => ['nullable', 'integer', 'min:0'],
            'mother_religion'   => ['nullable', 'string', 'max:50'],
            'mother_birthdate'  => ['nullable', 'date'],    
            'mother_profession' => ['nullable', 'string', 'max:100'],
            'mother_occupation' => ['nullable', 'string', 'max:100'],
        ];
    }
}
