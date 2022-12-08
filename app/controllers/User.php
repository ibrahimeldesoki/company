<?php

namespace app\controllers;

use app\core\Controller;

class User extends Controller
{
    public function __construct()
    {
        $this->model = $this->model('User');
    }
}