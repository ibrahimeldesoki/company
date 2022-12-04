<?php

namespace app\models;

class BaseModel
{
    protected $pdo;

    public function __construct()
    {
        require_once '../core/DataBaseConnection.php';
        $DBConnection = new DataBaseConnection();
        $this->pdo = $DBConnection->getPDO();
    }
}