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
echo $_SESSION['nom'];
?>

<html>
<head>
    <title> Classement </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"  href="style_index.css">
</head>

<body>

<div class="banniere">
    <?php
    menu_connexion();
    menu_navigation()
    ?>
</div>

<div class="container">
    <h3><?php echo 'Classement des apériiens' ?></h3>

    <table class="table table-bordered table-hover table-striped">
        <thead style="font-weight: bold">
        <td>#</td>
        <td>Prénom</td>
        <td>Nom</td>
        <td>Score</td>
        </thead>
        <?php /** @var \User\User $user */
        foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user->getId() ?></td>
                <td><?php echo $user->getPrenom() ?></td>
                <td><?php echo $user->getNom() ?></td>
                <td><?php echo $user->getScore() ?> points</td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>



