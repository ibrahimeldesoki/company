<?php

namespace App\Requests;

use App\core\Validation;

class CreateUserRequest extends Validation
{

    public function rules()
    {
        return [
            'user_name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }
}