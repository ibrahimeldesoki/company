<?php

namespace app\Utilities;

class TokenUtil
{
    public static function GenerateToken(): string
    {
        $bytes = openssl_random_pseudo_bytes(30);

        return bin2hex($bytes);
    }

//    public function
}