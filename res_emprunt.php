<?php 
session_start();


if(!empty($_POST['id_livre']))
{
	$id_livre=$_POST['id_livre'];
	
	$requete_avant="SELECT emprunte FROM livres WHERE id_livre =".$_POST['id_livre']." ; "; // requete pour verifier si le livre est emprunté (1 si emprunté, 0 sinon)
	
	
	if(($base = mysqli_connect('localhost', 'root', 'mdp', 'local31')))  // connexion à la base de donnée
	{
		$reponse = mysqli_query($base, $requete_avant);
		if($reponse){
			$tupleCourant = mysqli_fetch_assoc($reponse);
			if ($tupleCourant['emprunte'] == 0 ){ // on vérifie si le livre n est pas emprunté
				
				$date=date("Y/m/d");
				$requete_emprunts="INSERT INTO emprunts (id_emprunt,id_livre,emprunteur,date_emprunt,date_retour) VALUES (NULL, ".$_POST['id_livre'].",'".$_SESSION['login']."','".$date."',NULL);";
				
				$reponse = mysqli_query($base, $requete_emprunts); // On ajoute l'emprunt dans la liste des emprunts
					if($reponse){
						
						$requete_livre="UPDATE livres SET emprunte =1 WHERE id_livre = ".$_POST['id_livre'].";";
						
						$reponse = mysqli_query($base, $requete_livre); // On actualise le sattut du livre il est indisponible
						if($reponse){
							
							
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Emprunt d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>L'emprunt du livre a été confirmé.</p>
<a href="profil.php">Retour au profil.</a></br>
<a href="form_emprunt.php">Retour à la page d'emprunt.</a>
</body>
</html>
<?php
							
							
							
						}
						else{// erreur requete changement de statut
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors de l'emprunt d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Erreur lors de la requete.(2)</p>
<a href="form_emprunt.php">Retour à la page d'emprunt.</a>
</body>
</html>



<?php
						}
						
					}
					else//erreur requete d ajout de l'emprunt 
					{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors de l'emprunt d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Erreur lors de la requete.(1)</p>
<a href="form_emprunt.php">Retour à la page d'emprunt.</a>
</body>
</html>



<?php
						
					}
				
				
			}
			else // le livre n est pas disponible
			{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors de l'emprunt d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Le livre que vous voulez emprunter est indisponible.</p>
<a href="form_emprunt.php">Retour à la page d'emprunt.</a>
</body>
</html>



<?php
				
			}
			
			
		}
		else // erreur requete pour recuperer le statut du livre
		{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors de l'emprunt d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Erreur lors de la requete.</p>
<a href="form_emprunt.php">Retour à la page d'emprunt.</a>
</body>
</html>



<?php
			
			
		}
		
	}
	else // erreur connexion à la base de donnée
	{
		
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors de l'emprunt d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Erreur lors de la connexion à la base de donnée.</p>
<a href="form_emprunt.php">Retour à la page d'emprunt.</a>
</body>
</html>

<?php
		
	}
	
}
else // erreur champs du formulaires non remplis
{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors de l'emprunt d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Veuillez remplir tous les champs obligatoires.</p>
<a href="form_emprunt.php">Retour à la page d'emprunt.</a>
</body>
</html>

	
<?php
}

