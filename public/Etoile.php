<?php

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


session_start();
if (isset($_SESSION['login'])) {

    $id_utilisateur = $_SESSION['login'];


    $id_produit = $_POST['id_produit'];
    $etoile = $_POST['etoile'];



    /*ON UTILISE query POUR SELECT MAIS exec POUR INSERT DELETE ET UPDATE*/
    $connection->exec("INSERT INTO Note(id_produit, id_utilisateur, etoile)
    VALUES ('$id_produit', '$id_utilisateur', '$etoile')");

    header ('location: Ensemble_de_Produit.php');

}
else {

    header ('location: Connexion.html');
}

?>