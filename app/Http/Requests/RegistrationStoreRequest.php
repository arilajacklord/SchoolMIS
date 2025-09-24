<?php

namespace App\Http\Requests;

class RegistrationStoreRequest extends RegistrationFormRequest
{
    public function rules(): array
    {
        return $this->baseRules(); // all base rules apply
    }
}
