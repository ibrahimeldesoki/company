<?php

namespace app;
use app\core\App;

require_once 'core/DataBaseConnection.php';
require_once 'core/App.php';
require_once 'core/Controller.php';
$className  = "app\\core\\DataBaseConnection";
$dbConnection = new $className();
$app = new App();


