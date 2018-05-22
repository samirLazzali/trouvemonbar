<?php 
session_start();

$verif1=(!empty($_POST['titre']));
$verif2=(!empty($_POST['auteur']));
$verif3=(!empty($_POST['edition']));
$verif4=(!empty($_POST['date_de_parution']));
$verif5=(!empty($_POST['sorte']));
$verif6=(!empty($_POST['serie']));
$verif7=(!empty($_POST['tome']));
$verif8=(!empty($_POST['langue']));
$verif9=(!empty($_POST['resume']));
$verif10=(!empty($_POST['tag1']));

if($verif1&&$verif2&&$verif3&&$verif4&&$verif5&&$verif6&&$verif7&&$verif8&&$verif9&&$verif10){ // on verifie si tous les champs du formulaires sont remplis
	//creation de la requete
	if(!(empty($_POST['dessinateur'])) && $_POST['sorte'] == 'roman'){
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors de l'ajout d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Un roman ne peut pas avoir de dessinateur.</p>
<a href="form_rajout.php">Retour au formulaire de rajout</a>
</body>
</html>



<?php
		
	}
	else{
		if(!ctype_digit($_POST['tome'])){ // on verifie si le champ tome est bien un entier
?>

<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors de l'ajout d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Le numéro de tome doit être un entier.</p>
<a href="form_rajout.php">Retour au formulaire de rajout</a>
</body>
</html>

<?php
		}
		else
		{
			
			

			
			//on trouve l id de la serie
			$requete_serie = "SELECT id_serie FROM serie WHERE nom_serie LIKE '".$_POST['serie']."';";
			
		
			if(!($base = mysqli_connect('localhost', 'root', 'mdp', 'local31'))) // on se connecte à la base de donnée 
			{// erreur connexion a la base de donnée
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur ajout de livre</h1>
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
				$reponse = mysqli_query($base, $requete_serie);

				if($reponse){
					$tupleCourant = mysqli_fetch_assoc($reponse);
					
					$id_serie = $tupleCourant['id_serie'];
					
		//on a trouve l id de la serie 
				}
				else
				{// erreur si la serie n'existe pas
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur ajout de livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>La serie selectionnée n'existe pas.</p>
<a href="profil.php">Retour au profil</a>
</body>
</html>

<?php
			
			
				}
		
		
			
			}
		
		
		
		
		
		
		
		
			if(empty($_POST['dessinateur'])&&empty($_POST['tag2']) && empty($_POST['tag3'])){
				$requete= " INSERT INTO `livres` (`id_livre`, `titre`, `auteur`, `edition`, `date_de_parution`, `sorte`, `serie`, `id_serie`, `tome`, `langue`, `resume`, `tag1`,  `emprunte`) VALUES (NULL, '".$_POST['titre']."','".$_POST['auteur']."','".$_POST['edition']."','".$_POST['date_de_parution']."','".$_POST['sorte']."','".$_POST['serie']."','".$id_serie."','".$_POST['tome']."','".$_POST['langue']."','".$_POST['resume']."','".$_POST['tag1']."'";
			}
			if(!empty($_POST['dessinateur'])&&empty($_POST['tag2']) && empty($_POST['tag3'])){
				$requete= " INSERT INTO `livres` (`id_livre`, `titre`, `auteur`, `edition`, `date_de_parution`, `sorte`, `serie`, `id_serie`, `tome`, `langue`, `resume`, `dessinateur`, `tag1`,  `emprunte`) VALUES (NULL, '".$_POST['titre']."','".$_POST['auteur']."','".$_POST['edition']."','".$_POST['date_de_parution']."','".$_POST['sorte']."','".$_POST['serie']."','".$id_serie."','".$_POST['tome']."','".$_POST['langue']."','".$_POST['resume']."','".$_POST['dessinateur']."','".$_POST['tag1']."'";
			}
			if(!empty($_POST['dessinateur'])&&!empty($_POST['tag2']) && empty($_POST['tag3'])){
				$requete= " INSERT INTO `livres` (`id_livre`, `titre`, `auteur`, `edition`, `date_de_parution`, `sorte`, `serie`, `id_serie`, `tome`, `langue`, `resume`, `dessinateur`, `tag1`, `tag2`, `emprunte`) VALUES (NULL, '".$_POST['titre']."','".$_POST['auteur']."','".$_POST['edition']."','".$_POST['date_de_parution']."','".$_POST['sorte']."','".$_POST['serie']."','".$id_serie."','".$_POST['tome']."','".$_POST['langue']."','".$_POST['resume']."','".$_POST['dessinateur']."','".$_POST['tag1']."','".$_POST['tag2']."'";
			}
			if(!empty($_POST['dessinateur'])&&!empty($_POST['tag2']) && !empty($_POST['tag3'])){
				$requete= " INSERT INTO `livres` (`id_livre`, `titre`, `auteur`, `edition`, `date_de_parution`, `sorte`, `serie`, `id_serie`, `tome`, `langue`, `resume`, `dessinateur`, `tag1`, `tag2`, `tag3`, `emprunte`) VALUES (NULL, '".$_POST['titre']."','".$_POST['auteur']."','".$_POST['edition']."','".$_POST['date_de_parution']."','".$_POST['sorte']."','".$_POST['serie']."','".$id_serie."','".$_POST['tome']."','".$_POST['langue']."','".$_POST['resume']."','".$_POST['dessinateur']."','".$_POST['tag1']."','".$_POST['tag2']."','".$_POST['tag3']."'";
			}
			if(empty($_POST['dessinateur'])&&!empty($_POST['tag2']) && !empty($_POST['tag3'])){
				$requete= " INSERT INTO `livres` (`id_livre`, `titre`, `auteur`, `edition`, `date_de_parution`, `sorte`, `serie`, `id_serie`, `tome`, `langue`, `resume`, `tag1`, `tag2`, `tag3`, `emprunte`) VALUES (NULL, '".$_POST['titre']."','".$_POST['auteur']."','".$_POST['edition']."','".$_POST['date_de_parution']."','".$_POST['sorte']."','".$_POST['serie']."','".$id_serie."','".$_POST['tome']."','".$_POST['langue']."','".$_POST['resume']."','".$_POST['tag1']."','".$_POST['tag2']."','".$_POST['tag3']."'";
			}
			if(empty($_POST['dessinateur'])&&!empty($_POST['tag2']) && empty($_POST['tag3'])){
				$requete= " INSERT INTO `livres` (`id_livre`, `titre`, `auteur`, `edition`, `date_de_parution`, `sorte`, `serie`, `id_serie`, `tome`, `langue`, `resume`, `tag1`, `tag2`, `emprunte`) VALUES (NULL, '".$_POST['titre']."','".$_POST['auteur']."','".$_POST['edition']."','".$_POST['date_de_parution']."','".$_POST['sorte']."','".$_POST['serie']."','".$id_serie."','".$_POST['tome']."','".$_POST['langue']."','".$_POST['resume']."','".$_POST['tag1']."','".$_POST['tag2']."'";
			}
			$requete =$requete. ",'0' );";// on cree la requete pour inserer le nouveau livre
			$reponse = mysqli_query($base, $requete);
			if($reponse){
				$requete_serie="UPDATE serie SET nb_tomes_local = nb_tomes_local+1 WHERE id_serie = '".$id_serie."';";// on augmente de 1 le nombre de tomes disponible au local
				$reponse = mysqli_query($base, $requete_serie);
				if(!$reponse)
				{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors de l'ajout d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Erreur lors de la requete.</p>
<a href="form_rajout.php">Retour au formulaire de rajout</a>
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
<h1>Ajout d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Le livre a bien été ajouté à la base de donnée.</p>
<a href="profil.php">Retour au profil</a>
</body>
</html>
				
				
				
				
				
<?php			}
			}
			else{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors de l'ajout d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Erreur lors de la requete.</p>
<a href="form_rajout.php">Retour au formulaire de rajout</a>
</body>
</html>



<?php
				
			}
			
	
	
	
	
	
	
		}
	}
}
else{
?>
<html>
<meta charset="utf-8" />
<head>
<h1>Erreur lors de l'ajout d'un livre</h1>
<h2>Session de <?php echo $_SESSION['login']; ?></h2>
</head>
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>Veuillez remplir tous les champs obligatoires.</p>
<a href="form_rajout.php">Retour au formulaire de rajout</a>
</body>
</html>




<?php
	
}

