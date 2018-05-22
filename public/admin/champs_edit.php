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

$resultat=$connexion->query("SELECT login,mail,phone_number FROM Utilisateur WHERE id_user = ".$_POST['id_modif']);
$fetch = $resultat -> fetch(PDO::FETCH_OBJ);




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

	
	if($login_result == 'long')
	{
		$_SESSION['login_info'] = '<span class="erreur">Le nom d\'utilisateur '.htmlspecialchars($login, ENT_QUOTES).' est trop long, vous devez en choisir un plus court (maximum 32 caractères).</span><br/>';
		$_SESSION['form_login'] = '';
		$_SESSION['erreurs']++;
	}
	


	if($login_result == 'Ok' || ($login_result == 'pris' && $fetch->login == $login))
	{
		$_SESSION['login_info'] = '';
		$_SESSION['form_login'] = $login;
	}
	else if ($login_result == 'pris'){
		$_SESSION['login_info'] = '<span class="erreur">Le nom d\'utilisateur '.htmlspecialchars($login, ENT_QUOTES).' est déjà pris, choisissez-en un autre.</span><br/>';
		$_SESSION['form_login'] = '';
		$_SESSION['erreurs']++;			
	}
	
	if($login_result == 'vide')
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
			
	else if($mail_result == 'Ok' || ($mail_result == 'pris' && $fetch->mail == $mail))
	{
		$_SESSION['mail_info'] = '';
		$_SESSION['form_mail'] = $mail;
	}
	else if ($mail_result == 'pris'){
		$_SESSION['mail_info'] = '<span class="erreur">Le mail '.htmlspecialchars($mail, ENT_QUOTES).' est déjà pris.</span><br/>';
		$_SESSION['form_mail'] = '';
		$_SESSION['erreurs']++;			
	
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
		if($mail_verif_result == 'Ok' )
		{
			$_SESSION['mail_verif_info'] = '';
			$_SESSION['form_mail_verif'] = $mail_verif;
		}
		
		else
		{
			$_SESSION['mail_verif_info'] = '';
			$_SESSION['form_mail_verif'] = '';
			$_SESSION['erreurs']++;
		}
	}
}
if(isset($_POST['phone_number']))
{
	$phone_number = trim($_POST['phone_number']);
	$phone_number_result = checkphone($phone_number);
	if($phone_number_result == 'court')
	{
		$_SESSION['phone_number_info'] = '<span class="erreur">Le numéro de téléphone '.htmlspecialchars($phone_number, ENT_QUOTES).' est trop court.</span><br/>';
		$_SESSION['form_phone_number'] = '';
		$_SESSION['erreurs']++;
	}
	
	else if($phone_number_result == 'long')
	{
		$_SESSION['phone_number_info'] = '<span class="erreur">Le numéro de téléphone '.htmlspecialchars($phone_number, ENT_QUOTES).' est trop long.</span><br/>';
		$_SESSION['form_phone_number'] = '';
		$_SESSION['erreurs']++;
	}
		
	else if($phone_number_result == 'Ok' || ($phone_number_result == 'pris' && $fetch->phone_number == $phone_number))
	{
			$_SESSION['phone_number_info'] = '';
			$_SESSION['form_phone_number'] = $phone_number;
	}
	else if($phone_number_result == 'pris'){
		$_SESSION['phone_number_info'] = '<span class="erreur">Le numéro de téléphone '.htmlspecialchars($phone_number, ENT_QUOTES).' est déjà pris.</span><br/>';
		$_SESSION['form_phone_number'] = '';
		$_SESSION['erreurs']++;			
	}
	
	
	else if($phone_number_result == 'vide')
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

if($_SESSION['erreurs'] > 0) $titre = 'Erreur lors de la modification';
else $titre = 'Finalisation de la modification';

include('../includes/top.php');?>
		
		<div id="contenu">
			<?php
			if($_SESSION['erreurs'] == 0)
			{
				$dbName = getenv('DB_NAME');
				$dbUser = getenv('DB_USER');
				$dbPassword = getenv('DB_PASSWORD');
				$connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");



//				$req = 'UPDATE client SET nom_client = \''.test_input($nomMod).'\', debit_client = \''.format_number(test_input($debitMod)).'\' WHERE num_client = '.test_input($numCli)

//								if($connexion->exec("INSERT INTO Utilisateur VALUES(".$connexion->quote($fetch->max_id+1).", ".$connexion->quote($login).",
			//	".$connexion->quote($mail).",'".md5($password)."',".$connexion->quote($phone_number).",'1')"))


				if($connexion->exec("UPDATE Utilisateur SET login =".$connexion->quote($login).", mail = ".$connexion->quote($mail).",phone_number= ".$connexion->quote($phone_number)." WHERE id_user= '".$_POST['id_modif']."'"))
				

				{
					$queries++;
					
					$_SESSION['inscrit'] = $login;
				?>
				<h1>Modification validée !</h1></br>
				<p><a href="crud.php">Retour</a>.</p>
				<?php
				}
				
				else
				{
					if($_SESSION['form_login'] !== FALSE)
					{

						unset($_SESSION['form_login']);
						$_SESSION['login_info'] = '<span class="erreur">Le nom d\'utilisateur '.htmlspecialchars($login, ENT_QUOTES).' est déjà pris, choisissez-en un autre.</span><br/>';
						$_SESSION['erreurs']++;
					}
					
					if($_SESSION['form_mail'] !== FALSE)
					{
						unset($_SESSION['form_mail']);
						unset($_SESSION['form_mail_verif']);
						$_SESSION['mail_info'] = '<span class="erreur">Le mail '.htmlspecialchars($mail, ENT_QUOTES).' est déjà pris.</span><br/>';
						$_SESSION['mail_verif_info'] = '';
						$_SESSION['erreurs']++;
						$_SESSION['erreurs']++;
					}
					
					if($_SESSION['erreurs'] == 0)
					{
						$sqlbug = true;
						$_SESSION['erreurs']++;
					}
				}
			

			}
			
			if($_SESSION['erreurs'] > 0)
			{
				if($_SESSION['erreurs'] == 1) {
					$_SESSION['nb_erreurs'] = '<span class="erreur">Il y a eu 1 erreur.</span><br/>';
				}
				else {
					$_SESSION['nb_erreurs'] = '<span class="erreur">Il y a eu '.$_SESSION['erreurs'].' erreurs.</span><br/>';
				}
			?>
			<h1>Modification non validée.</h1>
			<p>En voici les raisons :<br/>
			<?php
				echo $_SESSION['nb_erreurs'];
				echo $_SESSION['login_info'];
				echo $_SESSION['mail_info'];
				echo $_SESSION['mail_verif_info'];
				echo $_SESSION['phone_number_info'];
				
				if(1)
				{
			?>
			Nous vous proposons donc de revenir à la page précédente pour corriger les erreurs.</p>
			<div class="center"><a href="crud.php">Retour</a></div>
			<?php
				}
				
				else
				{
			?>
			Une erreur est survenue dans la base de données, votre formulaire semble ne pas contenir d'erreurs, donc
			il est possible que le problème vienne de notre côté, nous vous conseillons de réessayer</p>
			
			<div class="center"><a href="crud.php">Retour</a>
			<?php
				}
			}
			?>
		</div>



		<?php
		unset($_SESSION['erreurs']);

		include('../includes/bottom.php');
		?>
