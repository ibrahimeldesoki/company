<?php

namespace app\models;

require_once  __DIR__."/BaseModel.php";

class User extends BaseModel
{
    private $userName;

    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserName($user)
    {
        $this->userName = $user;
    }
}