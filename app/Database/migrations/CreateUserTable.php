<?php

namespace app\Database\migrations;

use app\models\BaseModel;

require_once __DIR__ . '/../../models/BaseModel.php';

class CreateUserTable extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
        $this->migrate();
    }

    private function migrate()
    {
        $isMigrated = $this->ifExistTable('users');
        if (empty($isMigrated)) {
            $create = 'CREATE TABLE users (
                id int (11)  not null AUTO_INCREMENT,
                user_name varchar(50) not null ,
                email varchar(50) not null ,
                phone varchar(15),
                token varchar(60) not null ,
                primary key (id)
            )';

            $this->pdo->exec($create);
        }
    }
}
