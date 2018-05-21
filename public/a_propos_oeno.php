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
    <title> Oenologie  </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"  href="style_index.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
    menu_oeno();
?>
<br />
<br />
<br />
Avis à toi, futur soûlard, si jamais tu veux venir faire un petit tour à la maison, on t’a
réservé du blanc, du rouge, et même du saucisson, tu pourras y croiser Gillou avec
son p’tit accordéon, et on profitera des bouteilles, des copains et des chansons !
Que tu aimes les vins soyeux, souples, moelleux, fruités ou gouleyants, obséquieux,
nobles, rocambolesques, généreux, distingués, avec de la cuisse, volontaires,
onctueux, rondelets, corrélés, bourrus, redondants, biaisés, binaires, fougueux, exotiques,
astringents ou capiteux, tu trouveras forcément ton bonheur à OenologIIE,
alors n’hésite pas à venir picoler un petit pinard avec nous entre deux cours !
<img src="images/oenologie.png" alt="Logo Apéral" height="200" width="200">

