<?php

namespace app\Requests;

use app\core\Validation;

class CreateUserRequest
{
    public static function validate(array $request)
    {
        $rules = [
            'user_name' => ['required', 'integer'],
            'email' => ['required', 'string'],
            'password' => ['required', 'bool'],
        ];
        $validator = new Validation();

        return  $validator->validateRequest($request, $rules);

    }
}