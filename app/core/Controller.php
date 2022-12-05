<?php
namespace app\core;

class Controller
{
    protected $model;

    protected function model($modelName)
    {
        require_once '../app/models/' . $modelName . '.php';
        $className = "app\\models\\". $modelName;

        return new $className();
    }

    protected function view($view,$data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }
}