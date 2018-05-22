<?php

session_start();
header('Content-type: text/html; charset=utf-8');
include('../includes/config.php');

include('../includes/functions.php');
actualiser_session();

$_SESSION['erreurs'] = 0;
if(isset($_POST['cats']))
{
	$cats = trim($_POST['cats']);
}



if(isset($_POST['agemin']))
{
	$agemin = trim($_POST['agemin']);
}


if(isset($_POST['agemax']))
{
	$agemin = trim($_POST['agemax']);
}

if(isset($_POST['sizemin']))
{
	$agemin = trim($_POST['sizemin']);
}


if(isset($_POST['sizemax']))
{
	$sizemax = trim($_POST['sizemax']);
}

if(isset($_POST['coatmin']))
{
	$agemin = trim($_POST['coatmin']);
}


if(isset($_POST['coatmax']))
{
	$sizemax = trim($_POST['coatmax']);
}

if(isset($_POST['weightmin']))
{
	$agemin = trim($_POST['weightmin']);
}


if(isset($_POST['weightmax']))
{
	$sizemax = trim($_POST['weightmax']);
}

if(isset($_POST['pattern']))
{
	$agemin = trim($_POST['pattern']);
}

if(isset($_POST['breeds']))
{
	$agemin = trim($_POST['breeds']);
}


if(isset($_POST['colors']))
{
	$sizemax = trim($_POST['colors']);
}

if($_SESSION['erreurs'] > 0) $titre = 'Erreur lors de l\'ajout';
else $titre = 'Finalisation de l\'ajout';

include('../includes/top.php');?>
		
		<div id="contenu">
			<?php
			if($_SESSION['erreurs'] == 0)
			{
				$dbName = getenv('DB_NAME');
				$dbUser = getenv('DB_USER');
				$dbPassword = getenv('DB_PASSWORD');
				$connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
				
				if(($connexion->exec("UPDATE Cats SET sage_min = ".$connexion->quote($agemin).", sage_max=".$connexion->quote($agemax).", scsize_min = ".$connexion->quote(sizemin).",
				scsize_max=".$connexion->quote($sizemax).", scoat_min = ".$connexion->quote($coatmin).", scoat_max=".$connexion->quote($coatmax).",sweight_min = ".$connexion->quote($weightmin).",
				sweight_max=".$connexion->quote($weightmax).))
				&&
				($connexion->exec("INSERT INTO Searched_breeds VALUES(".$connexion->quote($cats).",".$connexion->quote($breeds).")"))
				&&
				($connexion->exec("INSERT INTO Searched_colors VALUES(".$connexion->quote($cats).",".$connexion->quote($colors).")")))) 
				{
					$queries++;
					$queries++;?>
					<h1>Recherches enregistrées !</h1>
					<?php }
			
				
				else
				{
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
			<h1>Ajout non validée.</h1>
			<p>Vous avez rempli le formulaire d'ajout de recherches du site et nous vous en remercions, cependant, nous n'avons
			pas pu valider votre inscription, en voici les raisons :<br/>
			<?php
				echo $_SESSION['nb_erreurs'];
				
				if(1)
				{
			?>
				Nous vous proposons donc de revenir à la page précédente pour corriger les erreurs.</p>
				<div class="center"><a href="search_cat.php">Retour vers l'ajout</a></div>
			<?php
				}
				
				else
				{
			?>
			Une erreur est survenue dans la base de données, votre formulaire semble ne pas contenir d'erreurs, donc
			il est possible que le problème vienne de notre côté, nous vous conseillons de réessayer d'ajouter votre chat.</p>
			
			<div class="center"><a href="search_cat.php">Retenter un ajout</a>
			<?php
				}
			}
			?>
		</div>

		<?php
		include('../includes/bottom.php');
		?>