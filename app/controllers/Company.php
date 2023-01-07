<?php

namespace app\controllers;

use app\core\Controller;
use app\Requests\CreateCompanyRequest;
use app\Requests\LoginCompanyRequest;
use app\Utilities\Password;
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

    public function login()
    {
        $CompanyLoginRequest = $_POST;
        $validationErrors = LoginCompanyRequest::validateRequest($CompanyLoginRequest);

        if (!empty($validationErrors['errors'])) {
            echo json_encode($validationErrors);
            die();
        }
        $company = $this->companyModel->findByMail($CompanyLoginRequest['email']);
        if (!$company || !Password::verify($CompanyLoginRequest['password'], $company['password'])){
            echo json_encode([
                'message' => 'Invalid credentials',
            ]);
            die();
        }

        echo json_encode([
            'message' => 'login successfully',
            'user_token' => $company['token'],
        ]);
    }
}