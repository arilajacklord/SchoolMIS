<?php

namespace App\Http\Requests;

class RegistrationUpdateRequest extends RegistrationFormRequest
{
    public function rules(): array
    {
        $rules = $this->baseRules();

        // If you had unique fields (like email), you'd adjust them here
        // Example: $rules['email'] = ['required','email','unique:registrations,email,' . $this->route('registration')->id];

        return $rules;
    }
}
