<?php

namespace app\Requests\Invoices;

use app\core\Validation;

class CreateInvoiceRequest extends Validation
{
    public function rules() :array
    {
        return [
            'company_id' => ['required', 'integer']
        ];
    }
}