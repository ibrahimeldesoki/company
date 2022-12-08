<?php

namespace app\models;

class BaseModel
{
    protected $pdo;

    public function __construct()
    {
        include_once __DIR__ . '/../core/DataBaseConnection.php';
        $className = "app\\core\\DataBaseConnection";

        $DBConnection = new $className();
        $this->pdo = $DBConnection->getPDO();
    }

    public function ifExistTable(string $tableName)
    {
        $sql = "SHOW TABLES LIKE '" . $tableName . "'";

        $q = $this->pdo->query($sql);

        return $q->fetch();
    }
}