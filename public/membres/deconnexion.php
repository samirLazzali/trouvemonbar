<?php


session_start();
include('../includes/config.php');


$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


session_destroy();

$informations = Array(/*Déconnexion*/
    false,
    'Déconnexion',
    'Vous êtes à présent déconnecté.',
    ' - <a href="'.ROOTPATH.'/membres/connexion.php">Se connecter</a>',
    ROOTPATH.'/index.php',
    5
);

require_once('../information.php');
exit();
?>