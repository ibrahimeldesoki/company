<?php

namespace app\models;

class BaseModel
{
    protected $pdo;

    public function __construct()
    {
        include_once '../app/core/DataBaseConnection.php';
        $className  = "app\\core\\DataBaseConnection";

        $DBConnection = new $className();
        $this->pdo = $DBConnection->getPDO();
    }
}