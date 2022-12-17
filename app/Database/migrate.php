<?php

namespace app\Database;
require_once __DIR__ . '/../../autoload.php';

use app\models\BaseModel;

class migrate extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
        $this->migrationProcess();
    }

    function migrationProcess()
    {
        $dir = __DIR__ . "/migrations";
        $migrationFiles = scandir($dir);
        foreach ($migrationFiles as $migrationFile) {
            if ($migrationFile != "." && $migrationFile != "..") {
                $className = pathinfo($migrationFile, PATHINFO_FILENAME);
                $isMigrated = $this->isMigrated($className);
                if (empty($isMigrated)){
                    $classNamespace = "app\\Database\\migrations\\" . $className;
                    $migrationObj = new $classNamespace();
                    $migrationObj->migrate();

                    $this->updateMigration($className);
                }

            }
        }
    }

    private function updateMigration(string $className)
    {
        $statement = $this->pdo->prepare("INSERT INTO migrations (class_name) VALUES (?)");
        $statement->execute([$className]);

        return true;
    }

    private function isMigrated(string $className) :bool
    {
        $statement = $this->pdo->prepare("SELECT id FROM migrations WHERE class_name=?");
        $statement->execute([$className]);
        $isMigrated = $statement->fetch();
        if ($isMigrated !== false)
        {
            return true;
        }
        return false;
    }
}


new migrate();


