<?php

namespace App\models;

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

    public function create(array $data = [])
    {
        $createUserStatement = 'INSERT INTO users (user_name , email ,password, phone,token) values (:user_name,:email,:password,:phone,:token)';
        try {
            $this->pdo->prepare($createUserStatement)->execute(
                [
                    ':user_name' => $data['user_name'],
                    ':email' => $data['email'],
                    ':password' => $data['password'],
                    ':phone' => $data['phone'] ?? null,
                    ':token' => $data['token']
                ]);
        } catch (\PDOException $exception) {
            return 'invalid request data';
        }

        return true;
    }

    public function findByMail(string $email)
    {
        $selectUser = 'SELECT * FROM users where email=:email';
        try {
            $user = $this->pdo->prepare($selectUser);
            $user->execute(['email'=>$email]);
            return $user->fetch();
        } catch (\PDOException $exception) {
            return 'invalid request data';
        }
    }
}