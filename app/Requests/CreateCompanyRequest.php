<?php

namespace app\Requests;

use app\core\Validation;

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