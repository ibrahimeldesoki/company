<?php
namespace app\Database;

use app\Interfaces\DBInterface;
use app\models\BaseModel;

class MigrationTable extends BaseModel implements DBInterface
{
    public function __construct()
    {

        parent::__construct();
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
}