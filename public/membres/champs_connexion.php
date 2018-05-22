<?php

session_start();
header('Content-type: text/html; charset=utf-8');
include('../includes/config.php');

include('../includes/functions.php');
actualiser_session();

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$result = $connexion->query("SELECT * FROM Utilisateur WHERE
							login = '".$_POST['login']."' GROUP BY id_user");
$result -> setFetchMode(PDO::FETCH_OBJ);
$fetch = $result->fetch();
global $queries;
$queries++;
if($fetch)
{
	if(md5($_POST['password']) == $fetch->password)
	{
		$_SESSION['id_user'] = $fetch->id_user;
		$_SESSION['login'] = $fetch->login;
		$_SESSION['password'] = $fetch->password;
		unset($_SESSION['connexion_login']);
						
		if(isset($_POST['cookie']) && $_POST['cookie'] == 'on')
		{
			setcookie('id_user', $fetch->id_user, time()+365*24*3600);
			setcookie('password', $fetch->password, time()+365*24*3600);
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
						'Vous avez fourni un mot de passe ou un nom d\'utilisateur incorrect.',
						' - <a href="'.ROOTPATH.'/index.php">Index</a>',
						ROOTPATH.'/membres/connexion.php',
						3
						);
		require_once('../information.php');
		exit();
	}
}
				
else if($fetch)
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
					'Nom d\'utilisateur ou mot de passe inconnu',
					'Le nom d\'utilisateur <span class="login">'.htmlspecialchars($_POST['login'], ENT_QUOTES).'</span> ou le mot de passe n\'existent pas dans notre base de données. Vous avez probablement fait une erreur.',
					' - <a href="'.ROOTPATH.'/index.php">Index</a>',
					ROOTPATH.'/membres/connexion.php',
					5
					);
	require_once('../information.php');
	exit();
}
?>	