<?php

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mot_de_passe = $_POST['mot_de_passe'];
$id_centre_commercial = $_POST['id_centre_commercial'];

$connection->exec("INSERT INTO Commercant(nom_commercant, prenom_commercant, mot_de_passe, id_centre_commercial)
    VALUES ('$nom', '$prenom', '$mot_de_passe', '$id_centre_commercial')");

header ('location:espace_commercants.php');





?>

