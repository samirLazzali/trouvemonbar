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
<link rel="stylesheet" type="text/css" href="main.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

<title>Connexion</title>

</head>
<body>
<?php include "upperBar.php" ?>

<center><h2>Connexion</h2></center>

<br/>
<form action="connexion.php" method="post">
  <div class="container">
    <label for="uname"><b>Pseudo</b></label><br/>
    <center><input type="text" placeholder="Entrez votre pseudo" name="uname" required></center>
    
    <label for="psw"><b>Mot de passe</b></label><br/>
    <center><input type="password" placeholder="Entrez votre mot de passe" name="psw" required></center>
    <br/><br/>
    <center><button type="submit">Login</button></center>
  </div>
</form>

<br/><center><p>Pas encore inscrit ? <a href="inscription.php" style=color:dodgerblue>Inscrivez-vous !</a></p></center>

</body>
</html>




