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

    public function findByMail(string $email)
    {
        $company = 'SELECT * FROM companies where email=:email';
        try {
            $company = $this->pdo->prepare($company);
            $company->execute(['email'=>$email]);
            return $company->fetch();
        } catch (\PDOException $exception) {
            return 'invalid request data';
        }
    }
}