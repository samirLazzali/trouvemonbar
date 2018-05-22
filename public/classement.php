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
/*$users = $userRepository->fetchAll();*/
$users = $connection->query('SELECT * FROM public.user ORDER BY score DESC')->fetchAll();

?>

<html>
<head>
    <title> Classement </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"  href="style_index.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>


    <?php
    menu_navigation();
    ?>

<div class="container">
    <br />
    <br />
    <br />
    <h2><?php echo 'Classement des apériiens' ?></h2>

    <table>
        <tr>
        <th>#</th>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Score</th>
	</tr>
        <?php /** @var \User\User $user */
        foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user['id'] ?></td>
                <td><?php echo $user['prenom'] ?></td>
                <td><?php echo $user['nom'] ?></td>
                <td><?php echo $user['score'] ?> points</td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>



