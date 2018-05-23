<?php


$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");



$nom = $_POST['nom'];
$mot_de_passe = $_POST['mot_de_passe'];


$rep = $connection->query("SELECT id_ad, mot_de_passe, nom_administrateur FROM  Administrateur")->fetchAll();
$a = 0;

foreach ($rep as $data)
{

if($data['nom_administrateur'] == $nom && $data['mot_de_passe'] == $mot_de_passe)
{
session_start();
$_SESSION['id_ad'] = $data['id_ad'];
$_SESSION['nom_ad'] = $nom;
$_SESSION['pwd_ad'] = $mot_de_passe;
$_SESSION['ok_ad'] =  0;
$a = 1;
header ('location: administration.php');
break;
}

}

if($a == 0) {
session_start();
$_SESSION['ok_commercant'] = -1;
header('location: index.php');
}



?>

