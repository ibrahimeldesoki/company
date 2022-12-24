<?php
namespace app\core;

use app\Interfaces\DBInterface;

class MigrationTable implements DBInterface
{
    private $pdo;

    public function __construct()
    {
        $DBConnection = new DataBaseConnection();
        $this->pdo =$DBConnection->getPDO();
        $this->migrate();
    }

    public function migrate()
    {
        $isMigrated = $this->ifExistTable('migrations');

        if (empty($isMigrated)) {
            $create = 'CREATE TABLE migrations (
                id int (11)  not null AUTO_INCREMENT,
                class_name varchar(50) not null ,
                primary key (id)
            )';

            $this->pdo->exec($create);
        }
    }

    public function ifExistTable(string $tableName)
    {
        $sql = "SHOW TABLES LIKE '" . $tableName . "'";

        $q = $this->pdo->query($sql);

        return $q->fetch();
    }
}