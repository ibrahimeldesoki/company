<?php

namespace App\controllers;

use App\Actions\CreateInvoiceAction;
use App\core\Controller;
use App\core\Response;
use App\models\Invoice as InvoiceModel;
use App\Requests\Invoices\CreateInvoiceRequest;

class Invoice extends Controller
{
    private InvoiceModel $invoiceModel;

    public function __construct()
    {
        $this->invoiceModel = $this->model('Invoice');
    }

    public function create()
    {
        $request = $_POST;
        $invoiceRequestErrors = CreateInvoiceRequest::validateRequest($request);
        if (!empty($invoiceRequestErrors['errors'])) {
            return new Response($invoiceRequestErrors['errors'], 422);
        }

        $count = $this->invoiceModel->getCompanyActiveAndPendingCount($request['company_id']);

        $invoiceData = CreateInvoiceAction::getInvoiceData($request['company_id'], $count);

        $invoice = $this->invoiceModel->create($invoiceData);
        if ($invoice !== true) {
            return new Response(['message' => 'something went wrong'], 400);
        }

        return new Response(['message' => 'invoice created successfully'], 200);
    }
}