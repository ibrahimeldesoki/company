<?php

class DataBaseConnection
{

    public $pdo;

    public function __construct()
    {
        $host = '127.0.0.1';
        $db = 'company';
        $username = 'root';
        $password = 'root';
        $port = 3306;
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    public function getPDO(){
        return $this->pdo;
    }
}