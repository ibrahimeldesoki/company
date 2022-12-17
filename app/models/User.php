<?php

namespace app\models;

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