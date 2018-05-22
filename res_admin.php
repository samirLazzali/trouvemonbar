<?php 
session_start();

$verif=(!empty($_POST['newAdmin']));

if($verif){
	
	
	
	$requete="UPDATE emprunteurs SET admin =1 WHERE pseudo LIKE '".$_POST['newAdmin']."' ;"; // requete pour ajouter un admin
	
	
	if(!($base = mysqli_connect('localhost', 'root', 'mdp', 'local31'))) // connexion à la base de donnée 
	{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur don des droits</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Erreur lors de la connexion à la base de données.</p>
<a href="profil.php">Retour au profil</a>
</body>
</html>

<?php
	}
	else
	{
		$reponse = mysqli_query($base, $requete);
		if($reponse){ // le don des dorits s'ets bien passé
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Don des droits</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Le don des droits a été éffectué.</p>
<a href="profil.php">Retour au profil</a>
</body>
</html>


<?php
				
		}
		else{// erreur lors de la requête
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur don des droits</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Erreur lors de la connexion à la base de données.</p>
<a href="profil.php">Retour au profil</a>
</body>
</html>
<?php
			
		}
	}
}

else{// tous les champs ne sont pas remplis
?>	
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur don des droits</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Veulliez remplir tous les champs pour valider le don des droits</p>
<a href="profil.php">Retour au profil</a>
</body>
</html>


<?php
}
?>