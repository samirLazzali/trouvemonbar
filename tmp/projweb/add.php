<?php 

session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
<title>Page Title</title>
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
  <a href="#admin"><a href="./administration.html">Administration</a></a>
  <a href="#deconnexion"><a href="./deconnexion.php">Déconnexion</a></a>
</div>

<?php 

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$GLOBALS['dbName']=$dbName;
$GLOBALS['dbUser']=$dbUser;
$GLOBALS['dbPassword']=$dbPassword;
$GLOBALS['connection']=$connection;
//On génère une clé primaire pour une épreuve
function get_pkey_epreuve(){
	$req="SELECT MAX(id_epreuve) FROM epreuve";
	$rep=$GLOBALS['connection']->prepare($req);
	$rep->execute();
	$result=$rep->fetch(PDO::FETCH_ASSOC);
	return($result['max']+1);
}
//Renvoie true si l'épreuve $nom existe, false sinon
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

function isInsertValid($description,$nom){
	return(strlen($description)<1000 && strlen($nom)<50 && strlen($nom)>0 && strlen($description)>0 && !exist_epreuve($nom));
}

if($_SESSION['status']=='admin'){
	$pkey=get_pkey_epreuve();
	$description=htmlspecialchars($_POST['description']);
	$nom=htmlspecialchars($_POST['nom']);
	$date=$_POST['date'];
	//On insère la nouvelle epreuve si les formulaires sont valides
	if(isInsertValid($description,$nom)){
		$req="INSERT INTO epreuve(id_epreuve,nom_e,date_e,description_e) VALUES($pkey,". $GLOBALS['connection']->quote($nom) .",". $GLOBALS['connection']->quote($date) .",". $GLOBALS['connection']->quote($description) .")";
		$rep=$GLOBALS['connection']->prepare($req);
		$rep->execute();
		echo "La nouvelle épreuve a bien été rajoutée<br/>";
		echo "Retour vers la page d'<a href='administration.php'>administration</a>";
	}
	//On renvoie vers la page d'administration sinon
	else{
		echo "Problème lors du remplissage du formulaire<br/>";
		echo "Retour vers la page d'<a href='administration.php'>administration</a>";
	}
}

else{
	echo "Vous ne disposez pas des droits suffisants pour ajouter une épreuve à la compétition<br/>";
	echo "Retour à la page de <a href=login.html>login</a><br/>";
}

?>