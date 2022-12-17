<?php

namespace app\Database\migrations;

use app\Interfaces\DBInterface;
use app\models\BaseModel;

class CreateUserTable extends BaseModel implements DBInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    public function migrate()
    {
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
