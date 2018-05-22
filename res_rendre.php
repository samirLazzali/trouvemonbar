<?php 
session_start();

if(!empty($_POST['id_livre']))
{
	$id_livre=$_POST['id_livre'];
	$requete_avant="SELECT * FROM livres WHERE id_livre =".$_POST['id_livre']." ; ";
	
	if(($base = mysqli_connect('localhost', 'root', 'mdp', 'local31')))  // connexion a la base de donnee
	{
		$verite=1;
		$requete_verif="SELECT * FROM emprunts LEFT JOIN livres ON emprunts.id_livre = livres.id_livre WHERE emprunteur ='".$_SESSION['login']."' AND date_retour is NULL ;";// on regarde si l utilisateur a bien emprunte ce livre
		$reponse= mysqli_query($base,$requete_verif);
		if($reponse)
		{
			$nbTuples = mysqli_num_rows($reponse);
			if($nbTuples!=0)
			{
				while ($tupleCourantV = mysqli_fetch_assoc($reponse) )
				{
					if($tupleCourantV['emprunteur'] == $_SESSION['login'])
					{
						$verite=0;
					}
				}
			}
			else
			{
				$verite=1;
			}
		}
		else
		{
			echo"erreur de requete";
		}
		
	
		if($verite==0) // si l utilisateur a bien emprunte le livre qu il veut rendre
		{
			$reponse = mysqli_query($base, $requete_avant);
			if($reponse){
				$tupleCourant = mysqli_fetch_assoc($reponse);
				if ($tupleCourant['emprunte'] == 1 ){// on regarde si le livre est bien dans le statut emprunte
					$date=date("Y/m/d");
					$requete_emprunt="UPDATE emprunts SET date_retour ='".$date."' WHERE id_livre = ".$_POST['id_livre'].";";// requete pour remplir la date de rendu
					$reponse = mysqli_query($base, $requete_emprunt);
						if($reponse){
							$requete_livre="UPDATE livres SET emprunte = 0 WHERE id_livre =".$_POST['id_livre'].";";// on remet le statut du livre a disponible
							$reponse = mysqli_query($base, $requete_livre);
							if($reponse){
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Rendu d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Le livre a bien été rendu.</p>
<a href="form_rendre.php">Retour à la page de rendu.</a></br>
<a href="profil.php">Retour au profil.</a></br>
</body>
</html>
		
		
<?php	
							
							}
							else
							{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors du rendu d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Erreur lors de la requete.</p>
<a href="form_rendre.php">Retour à la page de rendu.</a>
</body>
</html>
		
		
<?php	
							
							}
	
						
						}
						else
						{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors du rendu d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Erreur lors de la requete.</p>
<a href="form_rendre.php">Retour à la page de rendu.</a>
</body>
</html>
		
		
<?php	
						
						}
				}
				else
				{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors du rendu d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Le livre que vous voulez rendre n'est pas emprunté.</p>
<a href="form_rendre.php">Retour à la page de rendu.</a>
</body>
</html>
		
		
<?php	
				
				}
			
			}
			else
			{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors du rendu d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Erreur lors de la requete.</p>
<a href="form_rendre.php">Retour à la page de rendu.</a>
</body>
</html>
		
		
<?php	
			
			}
		
		}
		else
		{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Rendu d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Vous essayez de rendre le livre que quelqu'un d'autre a emprunté.</p>
<a href="form_rendre.php">Retour à la page de rendu.</a></br>
<a href="profil.php">Retour au profil.</a></br>
</body>
</html>
		
		
<?php
			
			
			
			
			
			
		}
	}
	else
	{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors du rendu d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Erreur lors de la connexion à la base de donnée.</p>
<a href="form_rendre.php">Retour à la page de rendu.</a>
</body>
</html>
		
		
<?php	
	}
}
else
{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors du rendu d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Veuillez remplir tous les champs obligatoires.</p>
<a href="form_rendre.php">Retour à la page de rendu.</a>
</body>
</html>

<?php
}
	
?>