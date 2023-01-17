<?php

namespace App\Utilities;

// just for test
class User implements \JsonSerializable
{
    private string $name;
    private string $email;

    public function __construct($name,$email)
    {
        $this->name = $name;
        $this->email = $email;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->getName(),
            'email' => $this->getEmail()
        ];
    }
}