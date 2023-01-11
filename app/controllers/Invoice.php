<?php

namespace App\controllers;

use App\Actions\CreateInvoiceAction;
use App\core\Controller;
use App\models\Invoice as InvoiceModel;
use App\Requests\Invoices\CreateInvoiceRequest;

class Invoice extends Controller
{
    private InvoiceModel $invoiceModel;

    public function __construct()
    {
        $this->invoiceModel =  $this->model('Invoice');
    }

    public function create()
    {
        $request = $_POST;
        $invoiceRequestErrors = CreateInvoiceRequest::validateRequest($request);
        if (!empty($invoiceRequestErrors['errors'])){
            echo json_encode($invoiceRequestErrors);
            die();
        }
        $count = $this->invoiceModel->getCompanyActiveAndPendingCount($request['company_id']);

        $invoiceData = CreateInvoiceAction::getInvoiceData($request['company_id'],$count);

        $invoice = $this->invoiceModel->create($invoiceData);
        if ($invoice !== true)
        {
            echo json_encode("something went wrong");
            die();

        }
        echo json_encode("DONE");
    }
}