<?php

namespace app\models;

class Company extends BaseModel
{
    public function create(array $data = [])
    {
        $createCompanyAccount = 'INSERT INTO companies
            (name , email ,password,token) 
            values 
                (:name,:email,:password,:token)';
        try {
            $this->pdo->prepare($createCompanyAccount)->execute(
                [
                    ':name' => $data['name'],
                    ':email' => $data['email'],
                    ':password' => $data['password'],
                    ':token' => $data['token']
                ]);
        } catch (\PDOException $exception) {
            return 'invalid request data';
        }

        return true;
    }

}