<?php


function DB()
{
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    try {
        $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
        return $connection;
    } catch (PDOException $e) {
        return "Error!: " . $e->getMessage();
        die();
        }
}

?>
