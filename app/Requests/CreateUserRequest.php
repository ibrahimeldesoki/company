<?php

namespace app\Requests;

use app\core\Validation;

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