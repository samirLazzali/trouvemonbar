<?php
require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


$msgManager = new \Message\MessageManager($connection);


$msg = new \Message\Message();



$msg->setEmetteur($_GET['emetteur']);
$msg->setRecepteur($_GET['recepteur']);
$msg->setDate(new DateTime);
$msg->setContenu($_GET['m']);

$msgManager->add($msg);


?>

