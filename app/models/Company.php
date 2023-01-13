<?php

namespace App\models;

class Company extends BaseModel
{
    public function create(array $data = [])
    {
        $createCompanyAccount = 'INSERT INTO companies
            (name , email ,password,token) 
            values 
                (:name,:email,:password,:token)';
            $this->pdo->prepare($createCompanyAccount)->execute(
                [
                    ':name' => $data['name'],
                    ':email' => $data['email'],
                    ':password' => $data['password'],
                    ':token' => $data['token']
                ]);

        return true;
    }

    public function findByMail(string $email)
    {
        $company = 'SELECT * FROM companies where email=:email';
            $company = $this->pdo->prepare($company);
            $company->execute(['email'=>$email]);
            return $company->fetch();
    }
}