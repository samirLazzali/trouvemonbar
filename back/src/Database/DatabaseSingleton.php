<?php
namespace Database;

class DatabaseSingleton
{
    private static $PDO = null;

    private function __construct() {}

    public static function getInstance()
    {
        if (is_null(self::$PDO)) {
            $dbName = getenv('DB_NAME');
            $dbUser = getenv('DB_USER');
            $dbPassword = getenv('DB_PASSWORD');
            self::$PDO = new \PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
        }
        return self::$PDO;
    }
}
