<?php
require '../vendor/autoload.php';
include('menu.php');
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
    <title> Oenologie  </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"  href="style_index.css">
</head>
<body>

<?php
menu_connexion();
menu_navigation()
?>


<div class="sous_menu" id="menu_oenologie">
    <form action="a_propos_aperal.php" method="post">
        <input type="submit" value="A propos">
    </form>
    <form action="preparatif_aperal.php" method="post">
        <input type="submit" value="Préparatifs">
    </form>
    <form action="liste_vin.php" method="post">
        <input type="submit" value="Liste des vins">
</div>