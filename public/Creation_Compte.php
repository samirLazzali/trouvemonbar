<?php

include("modele.php");

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manger pas cher ! Compte</title>
</head>
<body>';


$id_utilisateur = $_POST['id_utilisateur'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mot_de_passe = $_POST['mot_de_passe'];
$adresse = $_POST['adresse'];


insert_compte($id_utilisateur, $nom, $prenom, $mot_de_passe, $adresse);


echo '<a href="Page.html">Retour</a>
</body>
</html>';




?>
