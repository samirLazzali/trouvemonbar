<?php

session_start();
header('Content-type: text/html; charset=utf-8');
include('../includes/config.php');

include('../includes/functions.php');
actualiser_session();


include('../includes/top.php');

$titre = 'Suppression';


$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

if($connexion->query("DELETE FROM Utilisateur WHERE id_user =".$_GET['id_suppr']))
{
	echo '<p> La suppression de l\'utilisateur '.$_GET['id_suppr'].' a bien été effectuée';
}
else
{
	echo '<p> Erreur lors de la suppression';
}
?>
<br/>
<a href="crud.php">Retour</a>

<?php
include('../includes/bottom.php');
?>