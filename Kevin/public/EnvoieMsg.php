<?php
require '../vendor/autoload.php';
require '../src/Message/MessageManager.php';
require '../src/Message/Message.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


$msgManager = new \Message\MessageManager($connection);


$msg = new \Message\Message();


$recepteur = "Otis";

$msg->setEmetteur($_GET['pseudo']);
$msg->setRecepteur($recepteur);
$msg->setDate(new DateTime);
$msg->setContenu($_GET['m']);

$msgManager->add($msg);


echo("OKKK");
?>

