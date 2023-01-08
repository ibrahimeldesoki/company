<?php

namespace app\Requests;

use app\core\Validation;

class CompanySubscriberRequest extends Validation
{
    public function rules():array
    {
        return [
            'user_id' => ['required', 'integer'],
            'company_id' => ['required', 'integer'],
        ];
    }
}