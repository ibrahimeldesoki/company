<?php

namespace App;
use App\core\App;
use App\core\ExceptionHandler;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->safeLoad();
new ExceptionHandler();

require_once 'core/DataBaseConnection.php';
require_once 'core/App.php';
require_once 'core/Controller.php';
$DBConnection  = "App\\core\\DataBaseConnection";
new $DBConnection();
new App();


