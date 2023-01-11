<?php

namespace App;
use App\core\App;

require_once 'core/DataBaseConnection.php';
require_once 'core/App.php';
require_once 'core/Controller.php';
$className  = "App\\core\\DataBaseConnection";
$dbConnection = new $className();
$app = new App();


