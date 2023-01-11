<?php
namespace App\core;

class DataBaseConnection
{

    public $pdo;

    public function __construct()
    {

        $host = $_ENV['DB_HOST'];
        $db = $_ENV['DB_NAME'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $port = 3306;
        try {
            $this->pdo = new \PDO("mysql:host=$host;dbname=$db", $username, $password);
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    public function getPDO(){
        return $this->pdo;
    }
}