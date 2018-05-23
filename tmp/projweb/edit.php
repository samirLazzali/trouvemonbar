<?php 

session_start();
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$GLOBALS['dbName']=$dbName;
$GLOBALS['dbUser']=$dbUser;
$GLOBALS['dbPassword']=$dbPassword;
$GLOBALS['connection']=$connection;

$pseudo=htmlspecialchars($_GET['pseudo']);

if (!isset($_GET['pseudo']) || !isset($_SESSION['status']) || $_SESSION['pseudo']!=$_GET['pseudo']){
  echo "Vous êtes sur le mauvais profil ou vous n'êtes pas connecté<br/>";
  echo "Retour vers la liste des candidats <a href='liste.php'> ici </a><br/>";
  echo "Retour vers la page de login <a href='login.html'> ici </a><br/>";
}

else{
  echo "<form method='post' action='modification.php' enctype='multipart/form-data'>";
  echo "<label for='fileToUpload'>Nouvelle photo (max 5Mb) </label><br />";
  echo "<input type='file' name='fileToUpload' id='fileToUpload'><br /><br/>";
  echo "<label for='description'>Nouvelle description (500 caractères max)</label><br />";
  echo "<textarea name='description' id='description'></textarea><br />";
  echo "<input type='submit' name='submit' value='Envoyer' />";
  echo "</form>";
}

?>