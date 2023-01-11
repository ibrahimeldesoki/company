<?php

namespace App\models;

use App\core\DataBaseConnection;

class BaseModel
{
    protected $pdo;

    public function __construct()
    {
        $DBConnection = new DataBaseConnection();
        $this->pdo = $DBConnection->getPDO();
    }
}