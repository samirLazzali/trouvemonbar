<?php

session_start();
header('Content-type: text/html; charset=utf-8');
include('../includes/config.php');

include('../includes/functions.php');
connexion_bdd();
actualiser_session();
if(isset($_SESSION['id_user']))
{
	header('Location: '.ROOTPATH.'/index.php');
	exit();
}

$_SESSION['erreurs'] = 0;
if(isset($_POST['login']))
{
	$login = trim($_POST['login']);
	$login_result = checklogin($login);
	if($login_result == 'court')
	{
		$_SESSION['login_info'] = '<span class="erreur">Le nom d\'utilisateur '.htmlspecialchars($login, ENT_QUOTES).' est trop court, vous devez en choisir un plus long (minimum 3 caractères).</span><br/>';
		$_SESSION['form_login'] = '';
		$_SESSION['erreurs']++;
	}
	
	else if($login_result == 'long')
	{
		$_SESSION['login_info'] = '<span class="erreur">Le nom d\'utilisateur '.htmlspecialchars($login, ENT_QUOTES).' est trop long, vous devez en choisir un plus court (maximum 32 caractères).</span><br/>';
		$_SESSION['form_login'] = '';
		$_SESSION['erreurs']++;
	}
	
	else if($login_result == 'pris')
	{
		$_SESSION['login_info'] = '<span class="erreur">Le nom d\'utilisateur '.htmlspecialchars($login, ENT_QUOTES).' est déjà pris, choisissez-en un autre.</span><br/>';
		$_SESSION['form_login'] = '';
		$_SESSION['erreurs']++;
	}
		
	else if($login_result == 'Ok')
	{
		$_SESSION['login_info'] = '';
		$_SESSION['form_login'] = $login;
	}
	
	else if($login_result == 'vide')
	{
		$_SESSION['login_info'] = '<span class="erreur">Vous n\'avez pas entré de nom d\'utilisateur.</span><br/>';
		$_SESSION['form_login'] = '';
		$_SESSION['erreurs']++;	
	}
}

else
{
	header('Location: ../index.php');
	exit();
}

if(isset($_POST['password']))
{
	$password = trim($_POST['password']);
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

if(isset($_POST['password_verif']))
{
	$password_verif = trim($_POST['password_verif']);
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

//mail
if(isset($_POST['mail']))
{
	$mail = trim($_POST['mail']);
	$mail_result = checkmail($mail);
	if($mail_result == 'invalide')
	{
		$_SESSION['mail_info'] = '<span class="erreur">Le mail '.htmlspecialchars($mail, ENT_QUOTES).' n\'est pas valide.</span><br/>';
		$_SESSION['form_mail'] = '';
		$_SESSION['erreurs']++;
	}
	
	else if($mail_result == 'pris')
	{
		$_SESSION['mail_info'] = '<span class="erreur">Le mail '.htmlspecialchars($mail, ENT_QUOTES).' est déjà pris, <a href="../contact.php">contactez-nous</a> si vous pensez à une erreur.</span><br/>';
		$_SESSION['form_mail'] = '';
		$_SESSION['erreurs']++;
	}
		
	else if($mail_result == 'Ok')
	{
		$_SESSION['mail_info'] = '';
		$_SESSION['form_mail'] = $mail;
	}
	
	else if($mail_result == 'vide')
	{
		$_SESSION['mail_info'] = '<span class="erreur">Vous n\'avez pas entré de mail.</span><br/>';
		$_SESSION['form_mail'] = '';
		$_SESSION['erreurs']++;	
	}
}

else
{
	header('Location: ../index.php');
	exit();
}

if(isset($_POST['mail_verif']))
{
	$mail_verif = trim($_POST['mail_verif']);
	$mail_verif_result = checkmailS($mail_verif, $mail);
	if($mail_verif_result == 'different')
	{
		$_SESSION['mail_verif_info'] = '<span class="erreur">Le mail de vérification diffère du mail initial.</span><br/>';
		$_SESSION['form_mail_verif'] = '';
		$_SESSION['erreurs']++;
	}
	
	else
	{
		if($mail_result == 'Ok')
		{
			$_SESSION['mail_verif_info'] = '';
			$_SESSION['form_mail_verif'] = $mail_verif;
		}
		
		else
		{
			$_SESSION['mail_verif_info'] = str_replace(' mail', ' mail de vérification', $_SESSION['mail_info']);
			$_SESSION['form_mail_verif'] = '';
			$_SESSION['erreurs']++;
		}
	}
}
if(isset($_POST['phone_number']))
{
	$phone_number = trim($_POST['phone_number']);
	$phone_number_result = checkphone($phone_number);
	if($login_result == 'court')
	{
		$_SESSION['phone_number_info'] = '<span class="erreur">Le numéro de téléphone '.htmlspecialchars($phone_number, ENT_QUOTES).' est trop court.</span><br/>';
		$_SESSION['form_phone_number'] = '';
		$_SESSION['erreurs']++;
	}
	
	else if($login_result == 'long')
	{
		$_SESSION['phone_number_info'] = '<span class="erreur">Le numéro de téléphone '.htmlspecialchars($phone_number, ENT_QUOTES).' est trop long.</span><br/>';
		$_SESSION['form_phone_number'] = '';
		$_SESSION['erreurs']++;
	}
	
	else if($login_result == 'pris')
	{
		$_SESSION['phone_number_info'] = '<span class="erreur">Le numéro de téléphone '.htmlspecialchars($phone_number, ENT_QUOTES).' est déjà pris.</span><br/>';
		$_SESSION['form_phone_number'] = '';
		$_SESSION['erreurs']++;
	}
		
	else if($login_result == 'Ok')
	{
		$_SESSION['phone_number_info'] = '';
		$_SESSION['form_phone_number'] = $phone_number;
	}
	
	else if($login_result == 'vide')
	{
		$_SESSION['phone_number_info'] = '<span class="erreur">Vous n\'avez pas entré de numéro de téléphone.</span><br/>';
		$_SESSION['form_phone_number'] = '';
		$_SESSION['erreurs']++;	
	}
}

else
{
	header('Location: ../index.php');
	exit();
}
?>