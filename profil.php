<?php 
session_start();
if(!(empty($_SESSION['login']))){ // on vérifie si l'utilisateur ne s'est pas déjà connecté
	$user=$_SESSION['tuple'];
?>
	<html>
<head>
<h1>Vous êtes sur la page de votre profil</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<a href="recherche.php">Vous pouvez rechercher des livres.</a></br>

<a href="form_psw.php">Changer de mot de passe.</a></br>

<?php


if(!($connexion = mysqli_connect('localhost', 'root', 'mdp', 'local31'))) // connexion a la base de donnée  
{
        echo "Error : Database connect";
}
else
{
		$requete_profil="SELECT * FROM  emprunts LEFT JOIN livres ON emprunts.id_livre = livres.id_livre WHERE date_retour  is NULL AND emprunteur = '".$_SESSION['login']."';"; // on crée la requête pour chercher les livres que l'utilisateur a emprunté
		$reponse = mysqli_query($connexion, $requete_profil);
		if($reponse)
		{
			$nbTuples = mysqli_num_rows($reponse);
			if($nbTuples!=0){
				echo "<p>La liste de vos emprunts </p></br>";
				echo "<ul>";
				while ($tupleCourant = mysqli_fetch_assoc($reponse) ){
					$leTitre=$tupleCourant['titre'];
					$now_titre=utf8_encode("$leTitre");
					echo"<li>Titre: ".$now_titre." de ".$tupleCourant['auteur']." emprunté le ".$tupleCourant['date_emprunt'].".son id est ".$tupleCourant['id_livre'].". </li>" ;
					
				}
			}
			else
			{
				echo "pas d'emprunts";
			}
		}
		else
		{
			echo "erreur requete";
		}
echo "</ul>";	
echo"</br>";
}
if($nbTuples >3){
?>
<p>Vous devez rendre un livre avant d'en emprunter un nouveau</p>



<?php
	
}
else{

?>

<a href="form_emprunt.php">Vous pouvez emprunter des livres( récupérez son id en faisant une recherche d'abord).</a></br>
<?php
}
?>

<a href="form_rendre.php">Vous pouvez rendre un livre( récupérez son id en regardant dans la liste de vos emprunts).</a></br>
<?php 

if ($user['admin'] ==1){ // on vérifie si l'utilisateur posède les droits d'admin
?>
<p>Vous possèdez les droits d'administrateur.</p>
<a href="form_admin.php">Donnez les droits d'administrateur à un membre.</a> </br>

<a href="form_rajout.php">Rajoutez un livre dans la base de donnée.</a></br>

<a href="form_supp.php">Supprimez un livre de la base de donnée (Attention pour supprimer un livre, vous devez connaitre son id dans la base).</a></br>

<a href="form_ajout_serie.php">Ajoutez une série dans la base de donnée.</a></br>

<?php
}
?>
</br>
<a href="deconnexion.php">Déconnexion</a>



</body>
</html>
<?php	
}
else // le cas ou l'utilisateur vient de se connecter
{
	

	
	$verif1=!(empty($_GET['login']));
	$verif2=!(empty($_GET['psw']));

	if($verif1&&$verif2){ // on vérifie si tous les champs du formulaire sont remplis
		
		
		
		$requete = "SELECT * FROM emprunteurs WHERE pseudo LIKE \"".$_GET['login']."\" AND mdp LIKE \"".$_GET['psw']."\" ;";
		if(!($base = mysqli_connect('localhost', 'root', 'mdp', 'local31')))   
		{
?>
<html>
<head>
<h1>Erreur lors de la connexion.</h1>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Erreur lors de la connexion à la base de donnée.</p>
<a href="index.html">Retour à l'acceuil</a>
</body>

</html>

<?php
		
		}
		else
		{
			$reponse = mysqli_query($base, $requete);
	
	
			if($reponse){
				$nbTuples = mysqli_num_rows($reponse);
				if($nbTuples == 1){
					$user=mysqli_fetch_assoc($reponse);
			
				
					$_SESSION['tuple']= $user;
					$_SESSION['login']= $_GET['login']; // on remplit la variable $_SESSION
?>	
<html>
<head>
<h1>Vous êtes sur la page de votre profil</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">
<body>

<a href="recherche.php">Vous pouvez rechercher des livres.</a></br>

<a href="form_psw.php">Changer de mot de passe.</a></br>

<?php


if(!($connexion = mysqli_connect('localhost', 'root', 'mdp', 'local31')))   
{
        echo "Error : Database connect";
}
else
{
		$requete_profil="SELECT * FROM  emprunts LEFT JOIN livres ON emprunts.id_livre = livres.id_livre WHERE date_retour  is NULL AND emprunteur = '".$_SESSION['login']."';"; // on trouve les livres que l'utilisateur a emprunté
		$reponse = mysqli_query($connexion, $requete_profil);
		if($reponse)
		{
			$nbTuples = mysqli_num_rows($reponse);
			if($nbTuples!=0){
				echo "<p>La liste de vos emprunts </p></br>";
				echo "<ul>";
				while ($tupleCourant = mysqli_fetch_assoc($reponse) ){
					$leTitre=$tupleCourant['titre'];
					$now_titre=utf8_encode("$leTitre");
					echo"<li>Titre: ".$now_titre." de ".$tupleCourant['auteur']." emprunté le ".$tupleCourant['date_emprunt'].".son id est ".$tupleCourant['id_livre'].". </li>" ;
					
				}
			}
			else
			{
				echo "pas d'emprunts </br>";
			}
		}
		else
		{
			echo "erreur requete";
		}
echo "</ul>";
}

if($nbTuples>3){
?>
<p>Vous devez rendre un livre avant d'en emprunter un nouveau</p>


<?php
}
else
{
?>

<a href="form_emprunt.php">Vous pouvez emprunter des livres( récupérez son id en faisant une recherche d'abord).</a></br>

<?php
}
?>

<a href="form_rendre.php">Vous pouvez rendre un livre( récupérez son id en regardant dans la liste de vos emprunts).</a></br>
<?php 
					if ($user['admin'] ==1){
?>
<p>Vous possèdez les droits d'administrateur.</p>
<a href="form_admin.php">Donnez les droits d'administrateur à un membre.</a> </br>

<a href="form_rajout.php">Rajoutez un livre dans la base de donnée.</a></br>

<a href="form_supp.php">Supprimez un livre de la base de donnée (Attention pour supprimer un livre, vous devez connaitre son id dans la base).</a></br>

<a href="form_ajout_serie.php">Ajoutez une série dans la base de donnée.</a></br>

<?php
					}
?>
</br>
<a href="deconnexion.php">Déconnexion</a>



</body>
</html>


<?php
				}
				elseif($nbTuples == 0){
?>
<html>
<head>
<h1>Erreur lors de la connexion.</h1>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Ce compte n'existe pas.</p></br>
<a href="index.html">Retour à l'acceuil</a></br>
<p>Vous pouvez vous inscrire <a href="inscription.html">ici</a>.</p>
</body>

</html>

<?php
				}
		
			}
			else
			{
?>
<html>
<head>
<h1>Erreur lors de la connexion.</h1>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Echec dans la tentative de requête dans la base de dnnée.</p>
<a href="index.html">Retour à l'acceuil</a>
</body>

</html>


<?php
			}
		}
		mysqli_close($base); 
	}
	else
	{
?>
<html>
<head>
<h1>Erreur lors de la connexion.</h1>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Vous n'avez pas rempli tous les champs du formulaire.</p>
<a href="index.html">Retour à l'acceuil</a>
</body>

</html>


<?php
		
	}
}
