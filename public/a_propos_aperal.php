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
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
menu_aperal();
?>
<br />
<br />
<br />
<br />
<br />
<div class="container">
<h2> 51 je t'aime, j'en boirais des tonneaux </h2>
<br />
<p>
<span class="alinea">Cet ancien dicton énigmatique nous a été transmis d’antan par les dieux de l’apéro.
A Apéral, nous nous donnons comme mission divine de transmettre le savoir et les
bons moments ! Et comment ? Avec du saucisson ! Et de la boisson ! Et encore plus
de saucisson !<br /></span>
Chez nous l’apéritif n’est pas une manière de faire mais une manière d’être. Alors
viendez nombreux et assoiffés, et partagez avec nous l’art de la préparation (et
surtout de la consommation) de l’apéro !
</p>
</div>
<img class="center" src="images/aperal.png" alt="Logo Apéral" height="300" width="300">
</body>
</html>
