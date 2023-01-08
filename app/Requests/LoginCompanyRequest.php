<?php

namespace app\Requests;

use app\core\Validation;

class LoginCompanyRequest extends Validation
{
    public function rules() : array
    {
        return [
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }
}