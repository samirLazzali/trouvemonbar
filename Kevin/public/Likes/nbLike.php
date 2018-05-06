<?php
require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


$sth = $connection->prepare('SELECT count(tweet_id) AS nb FROM "like" WHERE tweet_id='.$_GET['T_id']);
$sth->execute();
$result = $sth->fetch(PDO::FETCH_OBJ);

echo $result->nb;


?>

