<?php 
session_start();
// POur ajouter un livre il faut que sa série soit ajoutée


if(!empty($_POST['nom_serie']) && !(empty($_POST['nb_tomes'])) && !(empty($_POST['auteur'])) && !(empty($_POST['resume'])) && !(empty($_POST['tag']))) // on vérifie si tous les champs sont remplis
{
	if(($base = mysqli_connect('localhost', 'root', 'mdp', 'local31'))) // connexion à la base de donnée 
	{
		$requete="INSERT INTO `serie` (`id_serie`, `nom_serie`, `nb_tomes`, `nb_tomes_local`, `auteur`, `resume`, `tags`) VALUES (NULL ,'".$_POST['nom_serie']."','".$_POST['nb_tomes']."','0','".$_POST['auteur']."','".$_POST['resume']."','".$_POST['tag']."' );";
		$reponse = mysqli_query($base, $requete);
			if($reponse){
?>
	
<html>
<meta charset="utf-8" />
<head>
<h1>Ajout d'une série</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>La série a bien été ajouté.</p>
<a href="form_ajout_serie.php">Retour à la page de rajout.</a></br>
<a href="profil.php">Retour au profil.</a>
</body>
</html>
	
<?php
				
			}
			else // erreur lors de la requete
			{
?>
	
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors de l'ajout d'une série</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Erreur lors de la requete.</p>
<a href="form_ajout_serie.php">Retour à la page de rajout.</a>
</body>
</html>
	
<?php
				
				
				
			}
	}
	
	
	
	else // erreur lors de la connexion
	{
?>
	
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors de l'ajout d'une série</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Erreur lors de la connexion à la base de donnée.</p>
<a href="form_ajout_serie.php">Retour à la page de rajout.</a>
</body>
</html>
	
<?php
		
	}
}
else//tous les champs n'ont pas été remplis
{
?>
	
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors de l'ajout d'une série</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Veuillez remplir tous les champs obligatoires.</p>
<a href="form_ajout_serie.php">Retour à la page de rajout.</a>
</body>
</html>
	
<?php
}
?>