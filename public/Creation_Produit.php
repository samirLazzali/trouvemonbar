<?php

include("modele.php");

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manger pas cher ! Produit</title>
</head>
<body>';



$id_produit = $_POST['id_produit'];
$categorie = $_POST['categorie'];
$types = $_POST['types'];
$marque = $_POST['marque'];
$prix = $_POST['prix'];
$date_de_peremption = $_POST['date_de_peremption'];
$reduction = $_POST['reduction'];
$quantite = $_POST['quantite'];
$id_centre_commercial = $_POST['id_centre_commercial'];

insert_produit($id_produit, $categorie, $types, $marque, $prix, $date_de_peremption, $reduction, $quantite, $id_centre_commercial);


echo '<a href="Page.html">Retour</a>
</body>
</html>';

?>
