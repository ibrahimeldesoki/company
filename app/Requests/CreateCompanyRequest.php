<?php

namespace App\Requests;

use App\core\Validation;

class CreateCompanyRequest extends Validation
{

    public function rules() :array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }
}