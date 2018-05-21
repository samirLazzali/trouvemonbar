<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="inscription.css" type="text/css">
<link rel="stylesheet" type="text/css" href="main.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

<title>Inscription</title>
</head>
<body>
<?php include "upperBar.php" ?>


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

<center><h2>Inscription</h2></center>

<br/>
<form id="inscription" action="inscription.php" method="post">
  <label for="pseudo"><b>Pseudo:</b></label><br>
  <center><input type="text" placeholder="Entrez votre pseudo" name="pseudo" required></center>
  
  <label for="mdp"><b>Mot de passe:</b></label><br>
  <center><input type="password" placeholder="Entrez votre mot de passe" name="mdp" required></center>
  
  <label for="mdp_verif"><b>Verification mot de passe:</b></label><br>
  <center><input type="password" placeholder="Entrez une nouvelle fois votre mot de passe" name="mdp_verif" required></center>
  <br/><br/>
  
  <center><button type="submit">Valider</button></center>
</form> 
<br/>
<center><p>By creating an account you agree to our <a href="terms&policy.jpg" style="color:dodgerblue">Terms & Privacy</a></p>
<p> Déjà inscrit ? <a href="connexion.php" style="color:dodgerblue">Connectez-vous !</a></p></center>

</body>
</html>


