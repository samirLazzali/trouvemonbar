<?php
session_start();
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
    <title> Apéral  </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"  href="style_index.css">
</head>
<body>

<div class="banniere">
<?php
menu_connexion();
menu_navigation();
?>
</div>
<?php
sous_menu_aperal();
?>

<h4>Aperal depuis la nuit des temps est considéré comme LA référence dans l'apéritif de compétition avec notament 3 coupe du monde à son actif</h4>
</body>
</html>
