<?php

namespace app\Utilities;

class Password
{
    public static function verify($RequestPassword, $entityPassword): bool
    {
        return  password_verify($RequestPassword, $entityPassword);
    }
}