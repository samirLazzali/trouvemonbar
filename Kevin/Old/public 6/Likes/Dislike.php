<?php
require '../../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$connection->exec('DELETE FROM "like" WHERE tweet_id = '.$_GET['T_id'].'AND user_id = '.$_GET['pseudo_id']);

?>

