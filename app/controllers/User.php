<?php

namespace app\controllers;

use app\core\Controller;
use app\Requests\CreateUserRequest;

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

        $validationErrors = CreateUserRequest::validate($request)['errors'];
        if(!empty($validationErrors)){
            echo json_encode(['errors' => $validationErrors]);
            die();
        }
        $request['password'] = password_hash($request['password'],PASSWORD_DEFAULT);
        $token = $this->createToken($request['password']);
        $request['token'] = $token;

        $user = $this->userModel->create($request);

        if ($user !== true)
        {
            echo json_encode(['errors' => $user]);
            die();
        }

        unset($request['password']);

        echo json_encode($request);
    }

    private function createToken(string $password)
    {
        return substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,60).rand(1,1000000);
    }
}