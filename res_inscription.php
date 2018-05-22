<?php


$verif=$_POST['valider'] == "valider";
if(isset($_POST['valider'],$verif)){
	
	$verif1=!(empty($_POST['nom']));
	$verif2=!(empty($_POST['prenom']));
	$verif3=!(empty($_POST['promo']));
	$verif4=!(empty($_POST['mail']));
	$verif5=!(empty($_POST['mdp']));
	$verif6=!(empty($_POST['login']));
	if($verif1&&$verif2&&$verif3&&$verif4&&$verif5&&$verif6){ // on vérifie si tous les champs sont remplis
		$requete="SELECT * FROM emprunteurs WHERE pseudo LIKE \"".$_POST['login']."\";";
	
		if(!($base = mysqli_connect('localhost', 'root', 'mdp', 'local31')))   // on se connecte à la base de donnée
		{
			echo "Error : Database connect";
		}
		else
		{
			$reponse = mysqli_query($base, $requete); // requete pour verifier si il n y a pas un autre compte avec le meme pseudo
	
	
			if($reponse){
				$nbTuples = mysqli_num_rows($reponse);
				if($nbTuples > 0){ // verification pour savoir si le pseudo n est pas deja pris 
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Inscription</h1>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Ce compte existe déjà.(Il ne faut pas piquer les pseudos d'autres iiens.)</br>Si l'iien n'est plus à l'école, vous pouvez contacter un administrateur pour enlever la personne de la base de données.</br></p>
<a href="inscription.html">Retour à la page d'inscription</a></br>
<a href="index.html">Retour à l'acceuil</a>
</body>
</html>
					
					
<?php					
				}
				
				else{
					
					$request="INSERT INTO `emprunteurs`( `prenom`, `nom`, `pseudo`, `promo`, `mail`, `mdp`, `admin`) VALUES ( '".$_POST['prenom']."', '".$_POST['nom']."','".$_POST['login']."', '".$_POST['promo']."', '".$_POST['mail']."', '".$_POST['mdp']."', '0');";
					$reponse = mysqli_query($base, $request); // on ajoute le compte dans les emprunteurs( il n est pas admin par défaut).
					if($reponse){
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Inscription</h1>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>La création de votre compte s'est déroulée sans problème.</br></p>
<a href="index.html">Retour à l'acceuil</a>
</body>
</html>




<?php

						
					}
					else{ // erreur lors de la requete d ajout dans la base de donnée
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Inscription</h1>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Erreur lors de la création de votre compte dans la base de données.</br></p>
<a href="inscription.html">Retour à la page d'inscription</a></br>
<a href="index.html">Retour à l'acceuil</a>
</body>
</html>
<?php
					}	
				}
			
			}
			else{// problème de connexion à la base de donnée
			?>
<html>
<meta charset="utf-8" />
<head>
<h1>Inscription</h1>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Erreur lors de la connexion à la base de données.</br></p>
<a href="inscription.html">Retour à la page d'inscription</a></br>
<a href="index.html">Retour à l'acceuil</a>
</body>
</html>
<?php
			
			
			}
		}
	}
	else // tous les chmaps du formulaires n ont pas été remplis
	{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Inscription</h1>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Veulliez remplir tous les champs pour valider l'inscription</p>
<a href="inscription.html">Retour à la page d'inscription</a></br>
<a href="index.html">Retour à l'acceuil</a>
</body>
</html>
<?php
	}	
}
?>
