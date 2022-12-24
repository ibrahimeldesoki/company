<?php

namespace app\models;

use app\core\DataBaseConnection;

class BaseModel
{
    protected $pdo;

    public function __construct()
    {
        $DBConnection = new DataBaseConnection();
        $this->pdo = $DBConnection->getPDO();
    }
}