<?php
namespace App\core;

class Controller
{
    protected $model;

    protected function model($modelName)
    {
        $className = "App\\models\\". $modelName;

        return new $className();
    }

    protected function view($view,$data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }
}