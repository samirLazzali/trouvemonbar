<?php

session_start();
if (isset($_SESSION['id_centre_commercant'])) {

    $id_centre_commercial = $_SESSION['id_centre_commercant'];

    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


    /*$id_produit = $_POST['id_produit'];*/
    $categorie = $_POST['categorie'];
    $types = $_POST['types'];
    $marque = $_POST['marque'];
    $prix = $_POST['prix'];
    $date_de_peremption = $_POST['date_de_peremption'];
    $reduction = $_POST['reduction'];
    $quantite = $_POST['quantite'];
    $image = $_POST['image'];

    //$id_centre_commercial = $_POST['id_centre_commercial'];


    /*ON UTILISE query POUR SELECT MAIS exec POUR INSERT DELETE ET UPDATE*/
    $connection->exec("INSERT INTO Produit(categorie, types, marque, prix, date_de_peremption, reduction, quantite, id_centre_commercial, image)
    VALUES ('$categorie', '$types', '$marque', '$prix', '$date_de_peremption', '$reduction', '$quantite', '$id_centre_commercial', '$image')");
    //var_dump($connection->errorInfo());
//$connection->commit();
    header ('location:espace_commercants.php');




}
else {

    header ('location:Connexion_Pro.html');
}

?>
