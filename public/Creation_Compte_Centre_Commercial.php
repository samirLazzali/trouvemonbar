<?php

include("config.php");

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manger pas cher ! Compte</title>
</head>
<body>';
//var_dump($_POST);die();

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


/*$id_centre_commercial = $_POST['id_centre_commercial'];*/
$enseigne = $_POST['enseigne'];
$horaire_debut = $_POST['horaire_debut'];
$horaire_fin = $_POST['horaire_fin'];
$adresse = $connection->quote($_POST['adresse']);



/*ON UTILISE query POUR SELECT MAIS exec POUR INSERT DELETE ET UPDATE*/
$connection->exec("INSERT INTO Centre_Commercial(enseigne, horaire_debut, horaire_fin, adresse)
    VALUES ('$enseigne', '$horaire_debut', '$horaire_fin', $adresse)");
var_dump($connection->errorInfo());
//$connection->commit();


echo '<a href="index.php">Retour</a>
</body>
</html>';




?>
