<?php

namespace App\Exceptions;


class Handler extends \Exception
{
    public static function report()
    {
        set_exception_handler(function ($e) {
            if ($e instanceof \PDOException)
            {
              echo  json_encode("some thing went wrong");
            }

        });
    }
}