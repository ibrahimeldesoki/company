<?php

namespace app\Requests;

use app\core\Validation;

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