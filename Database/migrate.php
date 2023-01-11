<?php

namespace Database;
require_once __DIR__ . '/../autoload.php';

use app\core\DataBaseConnection;
use app\core\MigrationTable;

class migrate
{
    protected $pdo;

    public function __construct()
    {
        $DBConnection = new DataBaseConnection();
        $this->pdo = $DBConnection->getPDO();
        $this->migrationProcess();
    }

    function migrationProcess()
    {
        $dir = __DIR__ . "/migrations";
        $migrationFiles = scandir($dir);

        foreach ($migrationFiles as $migrationFile) {

            if ($migrationFile != "." && $migrationFile != "..") {
                $className = pathinfo($migrationFile, PATHINFO_FILENAME);
                $newClassName = substr($className, strpos($className, "_") + 1);

                $isMigrated = $this->isMigrated($newClassName);
                if (empty($isMigrated)) {
                    $classNamespace = "Database\\migrations\\" . $className;
                    $migrationObj = new $classNamespace();

                    $createStatement = $migrationObj->migrate();
                    $this->pdo->exec($createStatement);

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

new MigrationTable();
new migrate();


