<?php

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$a = $_POST['rang'];

$connection->exec("DELETE FROM Panier WHERE id_panier = '$a'");

header ('location: Finaliser_Panier.php');

?>
