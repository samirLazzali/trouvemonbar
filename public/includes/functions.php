<?php

function sqlquery($connection,$requete, $number)
{
	$query = mysqli_query($connection,$requete) or exit('Erreur SQL : '.mysqli_error($connection).' Ligne : '. __LINE__ .'.');
	queries();
	
	if($number == 1)
	{
		$query1 = mysqli_fetch_assoc($query);
		mysqli_free_result($query);
		return $query1;
	}
	
	else if($number == 2)
	{
		while($query1 = mysqli_fetch_assoc($query))
		{
			$query2[] = $query1;
		}
		mysqli_free_result($query);
		return $query2;
	}
	
	else
	{
		exit('Argument de sqlquery non renseigné ou incorrect.');
	}
}

function queries($num = 1)
{
	global $queries;
	$queries = $queries + intval($num);
}

function connexion_bdd()
{
	$bd_nom_serveur='localhost';
	$bd_login='root';
	$bd_mot_de_passe='';
	$bd_nom_bd='catisfaction';
	
	//Connexion à la base de données
	$connection = mysqli_connect($bd_nom_serveur, $bd_login, $bd_mot_de_passe);
	mysqli_select_db($connection,$bd_nom_bd);
	mysqli_query($connection,"set names 'utf8'");
}

function actualiser_session()
{
	$bd_nom_serveur='localhost';
	$bd_login='root';
	$bd_mot_de_passe='';
	$bd_nom_bd='catisfaction';
	$connection = mysqli_connect($bd_nom_serveur, $bd_login, $bd_mot_de_passe);
	mysqli_select_db($connection,$bd_nom_bd);
	if(isset($_SESSION['id_user']) && intval($_SESSION['id_user']) != 0)
	{
		$retour = sqlquery($connection,"SELECT id_user, login, password FROM Utilisateur WHERE id_user = ".intval($_SESSION['id_user']), 1);
		if(isset($retour['login']) && $retour['login'] != '')
		{
			if($_SESSION['password'] != $retour['password'])
			{
				$informations = Array(/*Mot de passe de session incorrect*/
									true,
									'Session invalide',
									'Le mot de passe de votre session est incorrect, vous devez vous reconnecter.',
									'',
									'membres/connexion.php',
									3
									);
				require_once('../information.php');
				vider_cookie();
				session_destroy();
				exit();
			}
			
			else
			{
					$_SESSION['id_user'] = $retour['id_user'];
					$_SESSION['login'] = $retour['login'];
					$_SESSION['password'] = $retour['password'];
			}
		}
	}
	
	else
	{
		if(isset($_COOKIE['id_user']) && isset($_COOKIE['password']))
		{
			if(intval($_COOKIE['id_user']) != 0)
			{
				$retour = sqlquery($connection,"SELECT id_user, login, password	FROM Utilisateur WHERE id_user = ".intval($_COOKIE['id_user']), 1);
				
				if(isset($retour['login']) && $retour['login'] != '')
				{
					if($_COOKIE['password'] != $retour['password'])
					{
						$informations = Array(
											true,
											'Mot de passe cookie erroné',
											'Le mot de passe conservé sur votre cookie est incorrect vous devez vous reconnecter.',
											'',
											'membres/connexion.php',
											3
											);
						require_once('../information.php');
						vider_cookie();
						session_destroy();
						exit();
					}
					
					else
					{
						$_SESSION['id_user'] = $retour['id_user'];
						$_SESSION['login'] = $retour['login'];
						$_SESSION['password'] = $retour['password'];
					}
				}
			}
			
			else
			{
				$informations = Array(
									true,
									'Cookie invalide',
									'Le cookie conservant votre id est corrompu, il va donc être détruit vous devez vous reconnecter.',
									'',
									'membres/connexion.php',
									3
									);
				require_once('../information.php');
				vider_cookie();
				session_destroy();
				exit();
			}
		}
		
		else
		{
			if(isset($_SESSION['id_user'])) unset($_SESSION['id_user']);
			vider_cookie();
		}
	}
}

function vider_cookie()
{
	foreach($_COOKIE as $cle => $element)
	{
		setcookie($cle, '', time()-3600);
	}
}

function checklogin($login)
{
	$bd_nom_serveur='localhost';
	$bd_login='root';
	$bd_mot_de_passe='';
	$bd_nom_bd='catisfaction';
	$connection = mysqli_connect($bd_nom_serveur, $bd_login, $bd_mot_de_passe);
	mysqli_select_db($connection,$bd_nom_bd);
	if($login == '') return 'vide';
	else if(strlen($login) < 3) return 'court';
	else if(strlen($login) > 32) return 'long';
	
	else
	{
		$result = sqlquery($connection,"SELECT COUNT(*) AS nbr FROM Utilisateur WHERE login = '".mysqli_real_escape_string($connection,$login)."'", 1);
		global $queries;
		$queries++;
		
		if($result['nbr'] > 0) return 'pris';
		else return 'Ok';
	}
}

function checkpassword($password)
{
	$bd_nom_serveur='localhost';
	$bd_login='root';
	$bd_mot_de_passe='';
	$bd_nom_bd='catisfaction';
	$connection = mysqli_connect($bd_nom_serveur, $bd_login, $bd_mot_de_passe);
	mysqli_select_db($connection,$bd_nom_bd);
	if($password == '') return 'vide';
	else if(strlen($password) < 4) return 'court';
	else if(strlen($password) > 50) return 'long';
	
	else
	{
		if(!preg_match('#[0-9]{1,}#', $password)) return 'nonum';
		else if(!preg_match('#[A-Z]{1,}#', $password)) return 'nocaps';
		else return 'Ok';
	}
}

function checkpasswordS($password, $password2)
{
	if($password != $password2 && $password != '' && $password2 != '') return 'differents';
	else return checkpassword($password);
}

function checkmail($email)
{
	$bd_nom_serveur='localhost';
	$bd_login='root';
	$bd_mot_de_passe='';
	$bd_nom_bd='catisfaction';
	$connection = mysqli_connect($bd_nom_serveur, $bd_login, $bd_mot_de_passe);
	mysqli_select_db($connection,$bd_nom_bd);
	if($email == '') return 'Champ vide';
	else if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#is', $email)) return 'invalide';
	
	else
	{
		$result = sqlquery($connection,"SELECT COUNT(*) AS nbr FROM Utilisateur WHERE mail = '".mysqli_real_escape_string($connection,$email)."'", 1);
		global $queries;
		$queries++;
		
		if($result['nbr'] > 0) return 'pris';
		else return 'Ok';
	}
}

function checkmailS($email, $email2)
{
	if($email != $email2 && $email != '' && $email2 != '') return 'differents';
	else return 'Ok';
}

function checkphone($phone_number)
{
	$bd_nom_serveur='localhost';
	$bd_login='root';
	$bd_mot_de_passe='';
	$bd_nom_bd='catisfaction';
	$connection = mysqli_connect($bd_nom_serveur, $bd_login, $bd_mot_de_passe);
	mysqli_select_db($connection,$bd_nom_bd);
	if($phone_number == '') return 'vide';
	else if(strlen($phone_number) < 10) return 'court';
	else if(strlen($phone_number) > 10) return 'long';
	
	else
	{
		$result = sqlquery($connection,"SELECT COUNT(*) AS nbr FROM Utilisateur WHERE phone_number = '".mysqli_real_escape_string($connection,$phone_number)."'", 1);
		global $queries;
		$queries++;
		
		if($result['nbr'] > 0) return 'pris';
		else return 'Ok';
	}
}

function empty_session()
{
	foreach($_SESSION as $cle => $element)
	{
		unset($_SESSION[$cle]);
	}
}
?>