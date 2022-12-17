<?php

function getDirContents(string $className)
{
    $path = str_replace("\\", "/", $className);
    $path = "/" . $path . ".php";
    $path = realpath(__DIR__ . $path);

    require_once $path;
}

spl_autoload_register('getDirContents');
