<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
<title><?php echo htmlspecialchars($_GET['nom']);?></title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="style.css" />

<div class="hero-image">
  <div class="hero-text">
    <h1>MISTERIIE</h1>
    <p>Edition 2018/2019</p>
  </div>
</div>
<div class="navbar">
  <a href="#accueil"><a href="./main.html">Accueil</a></a>
  <a href="#candidats"><a href="./classement.php">Classement</a></a>
  <a href='#epreuves'><a href="./epreuves.php">Épreuves</a></a>
  <a href="#login"><a href="./login.html">Login</a>
  <a href="#signup"><a href="./Inscription.html">S'enregistrer</a></a>
  <a href="#admin"><a href="./administration.php">Administration</a></a>
  <a href="#deconnexion"><a href="./deconnexion.php">Déconnexion</a></a>
</div>
	<div class="epreuve">
<?php 
include("epreuvesData.php");

function exist_epreuve($nom){
	$sql_select="SELECT COUNT(*) FROM epreuve WHERE nom_e=". $GLOBALS['connection']->quote($nom)."";
	$rep=$GLOBALS['connection']->prepare($sql_select);
	$rep->execute();
	$result=$rep->fetch(PDO::FETCH_ASSOC);
	if($result['count']!=0)
		return true;
	else{
		return false;
	}
}

if(!isset($_GET['nom']) || !exist_epreuve($_GET['nom'])){
	echo "L'épreuve que vous souhaitez consulter n'existe pas<br/>";
	echo "Retour vers la <a href='epreuves.php'> list des épreuves </a>";
}
else{
	$nom=htmlspecialchars(urldecode($_GET['nom']));
	$req="SELECT description_e,date_e,id_epreuve FROM epreuve WHERE nom_e=". $GLOBALS['connection']->quote($nom) ."";
	$rep=$GLOBALS['connection']->prepare($req);
	$rep->execute();
	$res=$rep->fetch(PDO::FETCH_ASSOC);
	$description=$res['description_e'];
	$date=$res['date_e'];
	$id=$res['id_epreuve'];
	echo "<h1>$nom</h1>";
	echo "Date de l'épreuve : ".$date."<br/>";
	echo "<h2>Description de l'épreuve :</h2><br/> <article>$description</article>";
	echo "<h2>Liste des candidats inscrits à l'épreuve :</h2>";
	printCandidatsEpreuves($id);
	$link="inscriptionEpreuve.php?nom=".urlencode($nom);
	echo "Si vous ne vous êtes pas encore inscrits à l'épreuve, cliquez <a href=$link> ici </a>";
}
?>
	</div>
</body>
</html>
