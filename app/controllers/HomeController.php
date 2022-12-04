<?php

namespace  app\controllers;
use app\core\Controller;

//require_once  __DIR__."/HomeController.php";

class HomeController extends Controller
{
    public function __construct()
    {
        $this->model = $this->model('User');
    }

    public function index($name = "")
    {
        $this->model->setUSerName($name);

        $this->view('index', ['user_name'=> $this->model->getUserName()]);
    }

    public function test()
    {
        echo "test";
    }
}