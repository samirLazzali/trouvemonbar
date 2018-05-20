<?php
session_start();
require '../vendor/autoload.php'; 
//postgres 
$dbName = getenv('DB_NAME'); 
$dbUser = getenv('DB_USER'); 
$dbPassword = getenv('DB_PASSWORD'); 
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$userRepository = new \User\UserRepository($connection);
if (!empty($_POST)){
	$userRepository->connect($_POST['uname'],$_POST['psw']);
}
?>

<!DOCTYPE html>

<html>
<head>
<link rel="stylesheet" href="connexion.css" type="text/css">
<title>Connexion</title>

</head>
<body>

<h2>Connexion</h2>

<form action="connexion.php" method="post">
  <div class="container">
    <label for="uname"><b>Pseudo</b></label><br/>
    <input type="text" placeholder="Entrez votre pseudo" name="uname" required>
	<br/>
    <br/>
    <label for="psw"><b>Mot de passe</b></label><br/>
    <input type="password" placeholder="Entrez votre mot de passe" name="psw" required>
    <br/><br/>
    <button type="submit">Login</button>
  </div>
</form>

<center><p>Pas encore inscrit ? <a href="inscription.php" style=color:dodgerblue>Inscrivez-vous !</a></p></center>

</body>
</html>




