<?php

session_start();
include('../includes/config.php');
include('../includes/functions.php');

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$connexion->exec("DELETE FROM Connected WHERE id_connected = ".$_SESSION['id_user']);
vider_cookie();
session_destroy();

$informations = Array(/*Déconnexion*/
				false,
				'Déconnexion',
				'Vous êtes à présent déconnecté.',
				' - <a href="'.ROOTPATH.'/membres/connexion.php">Se connecter</a>',
				ROOTPATH.'/index.php',
				2
				);

require_once('../information.php');
exit();
?>