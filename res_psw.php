<?php 
session_start();


if(!empty($_POST['ancien_password']) && !(empty($_POST['password'])))
{
	$requete_avant="SELECT * FROM emprunteurs WHERE pseudo ='".$_SESSION['login']."' ; ";
	if($base = mysqli_connect('localhost', 'root', 'mdp', 'local31'))  
	{
		$reponse= mysqli_query($base,$requete_avant);
		if($reponse)
		{
			$tupleCourant=mysqli_fetch_assoc($reponse);
			if ($tupleCourant['mdp'] == $_POST['ancien_password']) // on verifie si l utilisateur a bien tape son ancien mot de passe
			{
				$requete ="UPDATE emprunteurs SET mdp = '".$_POST['password']."' WHERE pseudo ='".$_SESSION['login']."' ; ";
				$reponse= mysqli_query($base,$requete);// on change de mdp de l utilisateur dans la table des emprunteurs
				if($reponse)
				{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Changement de mot de passe</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Le changement de mot de passe s'est bien effectué.</p>
<a href="profil.php">Retour au profil.</a>
</body>
</html>


<?php
					
					
					
				}
				else // erreur requete changement de mot de passe
				{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors du changement de mot de passe</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Erreur lors de la requete.</p>
<a href="form_psw.php">Retour à la page de changement de mot de passe.</a>
</body>
</html>


<?php
					
					
				}
				
				
			}
			else// erreur l ancien mt de passe n est pas correctement tape
			{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors du changement de mot de passe</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Vous n'avez pas saisi le bon mot de passe.</p>
<a href="form_psw.php">Retour à la page de changement de mot de passe.</a>
</body>
</html>


<?php
				
				
			}
			
		}
		else// erreur lors de la requete de recuperation de mot de passe
		{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors du changement de mot de passe</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Erreur lors de la requete.</p>
<a href="form_psw.php">Retour à la page de changement de mot de passe.</a>
</body>
</html>


<?php
			
		}
	}
	else //erreur lors de la connexion à la base de donnée
	{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors du changement de mot de passe</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Erreur lors de la connexion à la base de donnée.</p>
<a href="form_psw.php">Retour à la page de changement de mot de passe.</a>
</body>
</html>


<?php
		
	}
	
}
else// erreur tous les champs du formulaires ne sont pas remplis
{
	
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors du changement de mot de passe</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Veuillez remplir tous les champs obligatoires.</p>
<a href="form_psw.php">Retour à la page de changement de mot de passe.</a>
</body>
</html>


<?php	
}
?>