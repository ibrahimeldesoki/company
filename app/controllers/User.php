<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Validation;
use app\Requests\CreateUserRequest;
use app\Requests\LoginUserRequest;
use app\Utilities\Password;
use app\Utilities\TokenUtil;

class User extends Controller
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function create()
    {
        $request = $_POST;
        $validationErrors =  CreateUserRequest::validateRequest($request);


        if(!empty($validationErrors)){
            echo json_encode($validationErrors);
            die();
        }
        $request['password'] = password_hash($request['password'],PASSWORD_DEFAULT);

        $request['token'] = TokenUtil::GenerateToken();

        $user = $this->userModel->create($request);

        if ($user !== true)
        {
            echo json_encode(['errors' => $user]);
            die();
        }

        unset($request['password']);

        echo json_encode($request);
    }

    public function login()
    {
        $loginRequest = $_POST;
        $validationErrors = LoginUserRequest::validateRequest($loginRequest);

        if (!empty($validationErrors['errors'])) {
            echo json_encode($validationErrors, http_response_code(Validation::unprocessableEntity));
            die();
        }
        $user = $this->userModel->findByMail($loginRequest['email']);
        if (!$user || ! Password::verify($loginRequest['password'], $user['password'])){
            echo json_encode([
                'message' => 'Invalid credentials',
            ]);
            die();
        }

            echo json_encode([
                'message' => 'login successfully',
                'user_token' => $user['token'],
            ]);
    }
}