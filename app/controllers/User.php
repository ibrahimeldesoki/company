<?php

namespace app\controllers;

use app\core\Controller;
use app\Requests\CreateUserRequest;

class User extends Controller
{
    public function __construct()
    {
        $this->model = $this->model('User');
    }

    public function create()
    {
        $request = $_POST;

       echo  json_encode(CreateUserRequest::validate($request));

    }
}