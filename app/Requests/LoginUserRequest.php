<?php

namespace App\Requests;

use App\core\Validation;

class LoginUserRequest extends Validation
{
    public function rules()
    {
        return [
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }
}