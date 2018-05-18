<?php
session_start();
require '../vendor/autoload.php';
require_once 'Vue.php';
//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$id1 = $_POST['personne']; 
$id2 = $_SESSION['id'];
$pseudo = prenom_user($id1);
supprimeramis($id2,$id1);
header("Location: profil.php?pseudo=$pseudo&id=$id1");
?>
