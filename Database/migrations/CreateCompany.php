<?php

namespace Database\migrations;

use app\Interfaces\DBInterface;

class CreateCompany implements DBInterface
{
    public function migrate(): string
    {
        return 'CREATE TABLE companies (
                    id int (11) not null AUTO_INCREMENT,
                    status ENUM(`pending`, `active`, `inactive`) NOT NULL DEFAULT `pending`,                    name varchar (255) not null,
                    email varchar (255) not null UNIQUE ,
                    password VARCHAR (255) not null,
                    token VARCHAR (255) not null,
                    primary key (id)

            )';
    }
}