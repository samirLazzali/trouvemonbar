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


if (isset($_SESSION['connect']) && $_SESSION['connect']==2) {
    echo '<html>';
    echo '<head>';
    echo '<title> profil  </title>';
    echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
    echo '<link rel="stylesheet" type="text/css"  href="style_index.css">';
    echo '</head>';
    echo '<body>';

    echo '<div class="banniere">';
    menu_connexion();
    menu_navigation();
    echo '</div>';

    echo '<h1>Réunions</h1>';
    echo '<form method="post" action="#">';
    echo '    <fieldset><legend>Soirée </legend><input type ="text" name="soiree" /></fieldset>';
    echo '    <fieldset><legend>Date </legend><input type="text" name="date" /></fieldset>';
    echo '    <fieldset><legend>Participant </legend><input type="text" name="participant" /></fieldset>';
    echo '    <fieldset><legend>Compte Rendu</legend><input type="text" name="cr" /></fieldset>';
    echo '   <input type ="submit" name="submit" value="Modifier"/>';
    echo '</form>';


   $req = $connection->prepare('INSERT INTO public.reunion(soiree,cr,datee,participant) VALUES(:soiree,:cr,:datee,:participant)');
    $test = $req->execute(['soiree' => $_POST['soiree'], 
        'cr' => $_POST['cr'],
        'datee' => $_POST['date'],
        'participant' => $_POST['participant'],  
    ]);
}
else {
    echo "<h2>Vous n'avez pas les droits</h2>";
    echo "<a href='index.php'>Acceuil</a>";
}
