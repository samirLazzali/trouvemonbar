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

<form method="post" action="changement_de_page.php" id="menu_bouton">
    <div classe="bouton"><input type="submit" name="acc" value="Accueil" ></div>
    <div classe="bouton"><input type="submit" name="ap" value="Apéral" ></div>
    <div classe="bouton"><input type="submit" name="oe" value="Oenologiie" ></div>
    <div classe="bouton"><input type="submit" name="reu" value="Réunion" ></div>
    <div classe="bouton"><input type="submit" name="clas" value="Classement" ></div>
    <div classe="bouton"><input type="submit" name="adm" value="Admin" ></div>
</form>


<div id="menu_aperal">
<form action="a_propos_aperal.php" method="post">
    <input type="submit" value="A propos">
</form>
<form action="preparatif_aperal.php" method="post">
    <input type="submit" value="Préparatifs">
</form>
<form action="recette.php" method="post">
    <input type="submit" value="Recettes">
</form>
<form action="intendance.php" method="post">
    <input type="submit" value="Intendance">
</form>
<form action="avis.php" method="post">
    <input type="submit" value="Avis">
</form>
</div>


le saucisson :saucisson