<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
<title>Administration</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="style.css" />

<div class="navbar">
  <a href="#accueil"><a href="./main.html">Accueil</a></a>
  <a href="#candidats"><a href="./classement.php">Classement</a></a>
  <a href='#epreuves'><a href="./epreuves.php">Épreuves</a></a>
  <a href="#login"><a href="./login.html">Login</a>
  <a href="#signup"><a href="./Inscription.html">S'enregistrer</a></a>
  <a href="#admin"><a href="./administration.html">Administration</a></a>
  <a href="#deconnexion"><a href="./deconnexion.php">Déconnexion</a></a>
</div>
<br/><br/>

<?php 
// On vérifie si la session est bien celle de l'admin
if(isset($_SESSION['status']) && $_SESSION['status']=='admin'){
	echo "Pour rajouter des épreuves cliquez <a href='addEpreuve.php'>ici</a>";
	$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	$dbPassword = getenv('DB_PASSWORD');
	$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

	$GLOBALS['dbName']=$dbName;
	$GLOBALS['dbUser']=$dbUser;
	$GLOBALS['dbPassword']=$dbPassword;
	$GLOBALS['connection']=$connection;
	//Cette fonction affiche les candidats sous la forme "prénom/pseudo/nom" avec un bouton "supprimer" qui supprime le candidat de la base de données
	function printCandidats(){
	  $req="SELECT prenom_c,pseudo_c,nom_c FROM candidat";
	  $result=$GLOBALS['connection']->query($req);
	  $result=$result->fetchAll();
	  $n=count($result);
	  $i=0;
	  while($i<$n){
	    $prenom=$result[$i][0];
	    $pseudo=$result[$i][1];
	    $nom=$result[$i][2];
	    $link="profil.php?pseudo=".$pseudo;
	    echo $prenom." ";
	    echo $pseudo." ";
	    echo $nom;
	    echo " : ";
	    echo "<a href=$link>$pseudo</a>";
	    echo "<form type='submit' action='suppression.php'><input type='submit' name='sub' value='Supprimer' /><input type='hidden' name='pseudo' value=$pseudo /><input type='hidden' name='status' value='candidat' /></form>";
	    echo "<br/>";
	    $i++;
	  }
	}
	//Meme chose l'administrateur peut supprimer un jury
	function printJurys(){
	  $req="SELECT prenom_j,pseudo_j,nom_j FROM jury";
	  $result=$GLOBALS['connection']->query($req);
	  $result=$result->fetchAll();
	  $n=count($result);
	  $i=0;
	  while($i<$n){
	    $prenom=$result[$i][0];
	    $pseudo=$result[$i][1];
	    $nom=$result[$i][2];
	    echo $prenom." ";
	    echo "\"".$pseudo."\""." ";
	    echo $nom;
	    echo "<form type='submit' action='suppression.php'><input type='submit' name='sub' value='Supprimer' /><input type='hidden' name='pseudo' value=$pseudo /><input type='hidden' name='status' value='jury' /></form>";
	    echo "<br/>";
	    $i++;
	  }
	}
	//On affiche ici les épreuves présentes dans la base de données avec un lien pour consulter l'épreuve, un bouuton pour supprimer l'épreuve ou bien la modifier.
	function printEpreuves(){
	  $req="SELECT nom_e FROM epreuve";
	  $result=$GLOBALS['connection']->query($req);
	  $result=$result->fetchAll();
	  $n=count($result);
	  $i=0;
	  while($i<$n){
	    $nom=$result[$i][0];
	    $encodednom=urlencode($nom);
	    $link="epreuve.php?nom=".$encodednom;
	    echo "<a href=$link>$nom</a>";
	    echo "<form type='submit' action='suppression.php'><input type='submit' name='sub' value='Supprimer' /><input type='hidden' name='nom' value=$encodednom /></form>";
	    echo "<form type='submit' action='modifEpreuve.php'><input type='submit' name='sub' value='Modifier' /><input type='hidden' name='nom' value=$encodednom /></form>";
	    echo "<br/>";
	    $i++;
	  }
	}	
	echo "<br/><h1>Liste des candidats</h1> <br/><br/>";
	printCandidats();
	echo "<br/>";
	echo "<br/>";
	echo "<h1>Liste des jurys</h1> <br/><br/>";
	printJurys();
	echo "<br/>";
	echo "<br/>";
	echo "<h1>Liste des épreuves</h1> <br/><br/>";
	printEpreuves();
}
else{
	echo "Vous n'êtes pas un administrateur !<br/>";
	echo "Retour vers la page de <a href=login.html>login</a>";
}
?>
