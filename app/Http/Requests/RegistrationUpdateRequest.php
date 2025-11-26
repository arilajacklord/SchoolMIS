<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegistrationUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on your auth logic
    }

    public function rules()
    {
        $registrationId = $this->route('registration')->id ?? null;
        $userId = $this->route('registration')->user_id ?? null;

        return [
            // User fields
                'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'], // optional, keep existing if empty

            // Student fields (same as store)
            'student_Fname'       => ['required', 'string', 'max:255'],
            'student_Mname'       => ['required', 'string', 'max:255'],
            'student_Lname'       => ['required', 'string', 'max:255'],
            'course_level'        => ['required', 'string', 'max:100'],
            'student_address'     => ['required', 'string', 'max:255'],
            'student_phone_num'   => ['required', 'string', 'max:20'],
            'student_status'      => ['required', 'string', 'max:50'],
            'student_citizenship' => ['required', 'string', 'max:100'],
            'student_birthdate'   => ['required', 'date'],
            'student_religion'    => ['required', 'string', 'max:50'],
            'student_age'         => ['required', 'integer', 'min:0'],

            // Father info
            'father_Fname'      => ['required', 'string', 'max:255'],
            'father_Mname'      => ['required', 'string', 'max:255'],
            'father_Lname'      => ['required', 'string', 'max:255'],
            'father_address'    => ['required', 'string', 'max:255'],
            'father_cell_no'    => ['required', 'string', 'max:20'],
            'father_age'        => ['required', 'integer', 'min:0'],
            'father_religion'   => ['required', 'string', 'max:50'],
            'father_birthdate'  => ['required', 'date'],
            'father_profession' => ['required', 'string', 'max:100'],
            'father_occupation' => ['required', 'string', 'max:100'],

            // Mother info
            'mother_Fname'      => ['required', 'string', 'max:255'],
            'mother_Mname'      => ['required', 'string', 'max:255'],
            'mother_Lname'      => ['required', 'string', 'max:255'],
            'mother_address'    => ['required', 'string', 'max:255'],
            'mother_cell_no'    => ['required', 'string', 'max:20'],
            'mother_age'        => ['required', 'integer', 'min:0'],
            'mother_religion'   => ['required', 'string', 'max:50'],
            'mother_birthdate'  => ['required', 'date'],
            'mother_profession' => ['required', 'string', 'max:100'],
            'mother_occupation' => ['required', 'string', 'max:100'],
        ];
    }
}
