<?php 
require '../vendor/autoload.php'; 
//postgres 
$dbName = getenv('DB_NAME'); 
$dbUser = getenv('DB_USER'); 
$dbPassword = getenv('DB_PASSWORD'); 
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);

$userRepository->signin($_POST['pseudo'],$_POST['mdp'],$_POST['mdp_verif']);

?>


