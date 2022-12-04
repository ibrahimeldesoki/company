<?php
namespace app\core;

class Controller
{
    protected $model;

    protected function model($modelName)
    {
        var_dump($modelName);
        require_once '../app/models/' . $modelName . '.php';

        return new $modelName();
    }

    protected function view($view,$data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }
}