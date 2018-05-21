<?php
require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();
?>

<html>
<head>
    <title> Apéral  </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"  href="style_index.css">
</head>
<body>

<div id="menu_bouton">
    <div class="bouton"><input type="submit" value="Acceuil" ></div>
    <div class="bouton"><input type="submit" value="Apéral" ></div>
    <div class="bouton"><input type="submit" value="Oenologiie" ></div>
    <div class="bouton"><input type="submit" value="Réunion" ></div>
    <div class="bouton"><input type="submit" value="Classement" ></div>
    <div class="bouton"><input type="submit" value="Admin" ></div>
</div>

<div id="menu_oeno">
<form action="a_propos_oeno.php" method="post">
    <input type="submit" value="A propos">
</form>
<form action="preparatif_oeno.php" method="post">
    <input type="submit" value="Préparatifs">
</form>
<form action="liste_des_vins.php" method="post">
    <input type="submit" value="Liste des vins">
</form>
</div>

Oenologie est l'une des plus prestigieuses associations de l'école de renomé mondiale : l'ENSIIE.