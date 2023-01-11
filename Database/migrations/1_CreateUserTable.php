<?php

namespace Database\migrations;

use App\Interfaces\DBInterface;

class CreateUserTable implements DBInterface
{
    public function migrate()
    {
        $create = 'CREATE TABLE users (
                id int (11)  not null AUTO_INCREMENT,
                user_name varchar(50) not null ,
                email varchar(50) not null UNIQUE,
                phone varchar(15),
                token varchar(60) not null ,
                primary key (id)
            )';

        return  $create;
    }
}
