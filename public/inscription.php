<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="inscription.css" type="text/css">
</head>
<body>


<?php 
require '../vendor/autoload.php'; 
//postgres 
$dbName = getenv('DB_NAME'); 
$dbUser = getenv('DB_USER'); 
$dbPassword = getenv('DB_PASSWORD'); 
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);

if (!empty($_POST)){
	$userRepository->signin($_POST['pseudo'],$_POST['mdp'],$_POST['mdp_verif']);
}

?>

<center><h1>Inscription</h1></center>

<form id="inscription" action="inscription.php" method="post">
  <b>Pseudo:</b><br>
  <input type="text" placeholder="Entrez votre pseudo" name="pseudo" required>
  <br><br>
  <b>Mot de passe:</b><br>
  <input type="password" placeholder="Entrez votre mot de passe" name="mdp" required>
  <br><br>
  <b>Verification mot de passe:</b><br>
  <input type="password" placeholder="Entrez une nouvelle fois votre mot de passe" name="mdp_verif" required>
  <br><br>
  
  <button type="submit">Valider</button>
</form> 

<center><p>By creating an account you agree to our <a href="terms&policy.jpg" style="color:dodgerblue">Terms & Privacy</a></p>
<p> Déjà inscrit ? <a href="connexion.php" style="color:dodgerblue">Connectez-vous !</a></p></center>

</body>
</html>


