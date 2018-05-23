<?php

//var_dump($_POST);die();

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


/*$id_utilisateur = $_POST['id_utilisateur'];*/
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mot_de_passe = $_POST['mot_de_passe'];
$adresse = $connection->quote($_POST['adresse']);



/*ON UTILISE query POUR SELECT MAIS exec POUR INSERT DELETE ET UPDATE*/
$connection->exec("INSERT INTO Utilisateur(nom_utilisateur, prenom_utilisateur, mot_de_passe, adresse, historique, commande)
    VALUES ('$nom', '$prenom', '$mot_de_passe', $adresse, 'NONE', 'NONE')");
//$connection->commit();
//CE N'EST PAS NECESSAIRE DE METTRE LES QUOTE POUR ADRESSE DEJA FAIT !

header('location: index.php');




?>
