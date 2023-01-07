<?php

namespace Database\migrations;

use app\Interfaces\DBInterface;

class CreateSubscribersTable implements DBInterface
{

    public function migrate(): string
    {
        return 'CREATE TABLE subscrsibers (
                    id int (11) not null AUTO_INCREMENT,
                    `user_id` int (6) not null,
                    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
                    `company_id` int (6),
                    FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ,
                    primary key (id)

            )';
    }
}