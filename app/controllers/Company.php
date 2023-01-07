<?php

namespace app\controllers;

use app\core\Controller;
use app\Requests\CreateCompanyRequest;
use app\Utilities\TokenUtil;

class Company extends Controller
{
    private $companyModel;

    public function __construct()
    {
        $this->companyModel = $this->model('Company');
    }

    public function create()
    {
        $request = $_POST;
        $validationErrors = CreateCompanyRequest::validateRequest($request);

        if (!empty($validationErrors['errors'])) {
            echo json_encode($validationErrors);
            die();
        }

        $request['password'] = password_hash($request['password'], PASSWORD_DEFAULT);
        $request['token'] = TokenUtil::GenerateToken();

       $company = $this->companyModel->create($request);

        if ($company !== true)
        {
            echo json_encode(['errors' => $company]);
            die();
        }

        unset($request['password']);

        echo json_encode($request);
    }
}