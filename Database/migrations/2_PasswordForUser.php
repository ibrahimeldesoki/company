<?php

namespace Database\migrations;

use app\Interfaces\DBInterface;

class PasswordForUser implements DBInterface
{
    public function migrate()
    {
        $addPassword = 'ALTER TABLE users ADD password VARCHAR( 255 ) after email';

        return $addPassword;
    }
}