<?php

function getDirContents(string $className)
{
    $path =  preg_replace("\\\\", "/","app\models\BaseModel");
    $path = "/" .$path .".php";
    $path = realpath(__DIR__.$path );

    require_once $path;
}


spl_autoload_register('getDirContents');
