<?php

session_start();
header('Content-type: text/html; charset=utf-8');
include('../includes/config.php');

include('../includes/functions.php');
actualiser_session();

<?php
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$result = $connexion->query("SELECT COUNT(id_user) AS nbr, id_user, login, password FROM Utilisateur WHERE
							login = '".$_POST['login']."' GROUP BY id_user");
global $queries;
$queries++;
if($result->nbr == 1)
{
	if(md5($_POST['password']) == $result->password)
	{
		$_SESSION['id_user'] = $result->id_user;
		$_SESSION['login'] = $result->login;
		$_SESSION['password'] = $result->password;
		unset($_SESSION['connexion_login']);
						
		if(isset($_POST['cookie']) && $_POST['cookie'] == 'on')
		{
			setcookie('id_user', $result->id_user, time()+365*24*3600);
			setcookie('password', $result->password, time()+365*24*3600);
		}
						
		$informations = Array(
						false,
						'Connexion réussie',
						'Vous êtes désormais connecté avec le nom d\'utilisateur <span class="login">'.htmlspecialchars($_SESSION['login'], ENT_QUOTES).'</span>.',
						'',
						ROOTPATH.'/index.php',
						3
						);
		require_once('../information.php');
		exit();
	}
	else
	{
		$_SESSION['connexion_login'] = $_POST['login'];
		$informations = Array(
						true,
						'Mauvais mot de passe',
						'Vous avez fourni un mot de passe incorrect.',
						' - <a href="'.ROOTPATH.'/index.php">Index</a>',
						ROOTPATH.'/membres/connexion.php',
						3
						);
		require_once('../information.php');
		exit();
	}
				
	else if($result->nbr > 1)
	{
		$informations = Array(
						true,
						'Doublon',
						'Deux membres ou plus ont le même nom d\'utilisateur, contactez un administrateur pour régler le problème.',
						' - <a href="'.ROOTPATH.'/index.php">Index</a>',
						ROOTPATH.'/contact.php',
						3
						);
		require_once('../information.php');
		exit();
	}
				
	else
	{	$informations = Array(
						true,
						'Nom d\'utilisateur inconnu',
						'Le nom d\'utilisateur <span class="login">'.htmlspecialchars($_POST['login'], ENT_QUOTES).'</span> n\'existe pas dans notre base de données. Vous avez probablement fait une erreur.',
						' - <a href="'.ROOTPATH.'/index.php">Index</a>',
						ROOTPATH.'/membres/connexion.php',
						5
						);
		require_once('../information.php');
		exit();
	}
}
?>	