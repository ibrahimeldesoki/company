<?php

namespace App\core;

use App\Exceptions\Handler;

class Exception
{
    public function __construct()
    {
        set_exception_handler(function ($e) {
            $handler = new Handler();
            $handler->render($e);
        });
    }
}