<?php

session_start();

$_SESSION['pseudo'] = $_POST['pseudo'];
$_SESSION['password'] = $_POST['password'];

if (isset($_POST['pseudo']) && isset($_POST['password']))
{
	if ($_POST['remember'])
	{
		setcookie('pseudo', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true);
		setcookie('password', password_hash($_POST['password']), time() + 365*24*3600, null, null, false, true);
	}
	$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	$dbPassword = getenv('DB_PASSWORD');
	$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
	$requete = $connection->prepare('SELECT password FROM membre WHERE pseudo LIKE ?');
	$password_bdd = $requete->execute(array($_POST['pseudo']));
	if (password_verify($password_bdd, password_hash($_POST)))
	{
		$_SESSION['error'] = 1;
		header('Location: connexion.php');
	}
	header('Location: index.php');
}

?>