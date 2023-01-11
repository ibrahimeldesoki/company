<?php

namespace App\Requests\Invoices;

use App\core\Validation;

class CreateInvoiceRequest extends Validation
{
    public function rules() :array
    {
        return [
            'company_id' => ['required', 'integer']
        ];
    }
}