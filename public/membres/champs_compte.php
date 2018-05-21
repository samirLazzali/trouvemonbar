<?php

session_start();
header('Content-type: text/html; charset=utf-8');
include('../includes/config.php');

include('../includes/functions.php');
actualiser_session();

$_SESSION['erreurs'] = 0;

if(isset($_POST['old']))
{
	$old = trim($_POST['old']);
	$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	$dbPassword = getenv('DB_PASSWORD');
	$connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
	$result = $connexion -> query("SELECT password FROM Utilisateur WHERE id_user = ".intval($_SESSION['id_user']));
	$result -> setFetchMode(PDO::FETCH_OBJ);
	$result -> fetch();
	$mdp_verif = $result -> password;
	$mdp_result = checkpasswordS($mdp_verif, $old);
	if($mdp_result == 'differents')
	{
		$_SESSION['password_verif_info'] = '<span class="erreur">L\'ancien mot de passe entré diffère du mot de passe initial.</span><br/>';
		$_SESSION['form_password_verif'] = '';
		$_SESSION['erreurs']++;
		if(isset($_SESSION['form_password'])) unset($_SESSION['form_password']);
	}
	
	else
	{
		if($mdp_result == 'Ok')
		{
			$_SESSION['form_password_verif'] = $mdp_verif;
			$_SESSION['password_verif_info'] = '';
		}
		
		else
		{
			$_SESSION['password_verif_info'] = str_replace('passe', 'passe de vérification', $_SESSION['password_info']);
			$_SESSION['form_password_verif'] = '';
			$_SESSION['erreurs']++;
		}
	}
}

if(isset($_POST['new']))
{
	$password = trim($_POST['new']);
	$password_result = checkpassword($password, '');
	if($password_result == 'court')
	{
		$_SESSION['password_info'] = '<span class="erreur">Le mot de passe entré est trop court, changez-en pour un plus long (minimum 4 caractères).</span><br/>';
		$_SESSION['form_password'] = '';
		$_SESSION['erreurs']++;
	}
	
	else if($password_result == 'long')
	{
		$_SESSION['password_info'] = '<span class="erreur">Le mot de passe entré est trop long, changez-en pour un plus court. (maximum 50 caractères)</span><br/>';
		$_SESSION['form_password'] = '';
		$_SESSION['erreurs']++;
	}
	
	else if($password_result == 'nonum')
	{
		$_SESSION['password_info'] = '<span class="erreur">Votre mot de passe doit contenir au moins un chiffre.</span><br/>';
		$_SESSION['form_password'] = '';
		$_SESSION['erreurs']++;
	}
		
	else if($password_result == 'nocaps')
	{
		$_SESSION['password_info'] = '<span class="erreur">Votre mot de passe doit contenir au moins une majuscule.</span><br/>';
		$_SESSION['form_password'] = '';
		$_SESSION['erreurs']++;
	}
		
	else if($password_result == 'Ok')
	{
		$_SESSION['password_info'] = '';
		$_SESSION['form_password'] = $password;
	}
	
	else if($password_result == 'vide')
	{
		$_SESSION['password_info'] = '<span class="erreur">Vous n\'avez pas entré de mot de passe.</span><br/>';
		$_SESSION['form_password'] = '';
		$_SESSION['erreurs']++;

	}
}

else
{
	header('Location: ../index.php');
	exit();
}

if(isset($_POST['confirm']))
{
	$password_verif = trim($_POST['confirm']);
	$password_verif_result = checkpasswordS($password_verif, $password);
	if($password_verif_result == 'differents')
	{
		$_SESSION['password_verif_info'] = '<span class="erreur">Le mot de passe de vérification diffère du mot de passe initial.</span><br/>';
		$_SESSION['form_password_verif'] = '';
		$_SESSION['erreurs']++;
		if(isset($_SESSION['form_password'])) unset($_SESSION['form_password']);
	}
	
	else
	{
		if($password_verif_result == 'Ok')
		{
			$_SESSION['form_password_verif'] = $password_verif;
			$_SESSION['password_verif_info'] = '';
		}
		
		else
		{
			$_SESSION['password_verif_info'] = str_replace('passe', 'passe de vérification', $_SESSION['password_info']);
			$_SESSION['form_password_verif'] = '';
			$_SESSION['erreurs']++;
		}
	}
}

else
{
	header('Location: ../index.php');
	exit();
}