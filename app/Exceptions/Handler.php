<?php

namespace App\Exceptions;

class Handler
{
    function render($e)
    {
        if ($e instanceof \PDOException) {
            echo json_encode("some thing went wrong");
        }
    }
}