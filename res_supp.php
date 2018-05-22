<?php 
session_start();

$verif=!(empty($_POST['id']));
if($verif){
	$requete="DELETE FROM livres WHERE id_livre = ".$_POST['id'] ;// requte pour enlever le livre de la base de donnée
	
	if(($base = mysqli_connect('localhost', 'root', 'mdp', 'local31')))  // connexion à la base de donnée
	{
		$reponse = mysqli_query($base, $requete);
		if($reponse){
			
			$requete_join="SELECT livres.id_serie,livres.id_livre FROM serie LEFT JOIN livres ON nom_serie=serie WHERE id_livre =".$_POST['id'].";";// requete pour connaitre l id de la serie du livre qu on veut supprimer
			$reponsei = mysqli_query($base, $requete_join);
			if(!$reponsei)
			{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors de la suppression d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Erreur lors de la requête.</p>
<a href="form_supp.php">Retour à la page de suppression</a>
</body>
</html>

<?php
			
			
			
			
			}
			else{
			
				$tuplenow = mysqli_fetch_assoc($reponsei);
				
				$id_serie = $tuplenow['id_serie'];
				
				echo $id_serie;
				$requete_serie="UPDATE serie SET nb_tomes_local = nb_tomes_local-1 WHERE id_serie = ".$id_serie.";";// requete pour diminuer de 1 le nombre de livre present au local de cette serie
				$reponse = mysqli_query($base, $requete_serie);
				if(!$reponse)
				{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Suppression d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>La suppression s'est bien passée.</p>
<a href="profil.php">Retour au profil</a>
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
<h1>Suppression d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>La suppression s'est bien passée.</p>
<a href="profil.php">Retour au profil</a>
</body>
</html>





<?php
				}
			}
		}
		
		else
		{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors de la suppression d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Erreur lors de la requête.</p>
<a href="form_supp.php">Retour à la page de suppression</a>
</body>
</html>




<?php
			
			
		}
		
		
		
		
		
	}
	else{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors de la suppression d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Erreur lors de la connexion à la base de donnée.</p>
<a href="form_supp.php">Retour à la page de suppression</a>
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
<h1>Erreur lors de la suppression d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Veuillez remplir tous les champs obligatoires.</p>
<a href="form_supp.php">Retour à la page de suppression</a>
</body>
</html>

<?php
	
}

?>
