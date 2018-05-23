<?php session_start();?>
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
//Renvoie true si le candidat d'id $id participe à l'épreuve d'id $id_e
function exist_candidat_inCE($id,$id_e){
		$sql_select="SELECT COUNT(*) FROM candidat_epreuve WHERE id_candidat=$id AND id_epreuve=$id_e";
		$rep=$GLOBALS['connection']->prepare($sql_select);
		$rep->execute();
		$result=$rep->fetch(PDO::FETCH_ASSOC);
		if($result['count']!=0)
			return true;
		else{
			return false;
		}
	}

if(!isset($_SESSION['status']) || $_SESSION['status']!='candidat'){
	echo "Vous n'êtes pas connecté ou vous n'êtes pas un candidat !<br/>";
	echo "Aller à la page de <a href='login.html'> login</a>";
}

else if( !(isset($_GET['nom'])) || strlen($_GET['nom'])==0){
	echo "L'épreuve n'existe pas !<br/>";
	echo "Retour vers la <a href='epreuves.php'>liste des épreuves</a>";
}

else{
	$nom_e=htmlspecialchars(urldecode($_GET['nom']));
	$pseudo=$_SESSION['pseudo'];
	$req="SELECT id_candidat FROM candidat WHERE pseudo_c=". $GLOBALS['connection']->quote($pseudo)."";
	$rep=$GLOBALS['connection']->prepare($req);
	$rep->execute();
	$result=$rep->fetch(PDO::FETCH_ASSOC);
	$id_candidat=$result['id_candidat'];
	$req="SELECT id_epreuve FROM epreuve WHERE nom_e=". $GLOBALS['connection']->quote($nom_e) ."";
	$rep=$GLOBALS['connection']->prepare($req);
	$rep->execute();
	$res=$rep->fetch(PDO::FETCH_ASSOC);
	$id_epreuve=$res['id_epreuve'];
	if(!exist_candidat_inCE($id_candidat,$id_epreuve)){
		$req="INSERT INTO candidat_epreuve(id_epreuve,id_candidat,id_jury,note) VALUES($id_epreuve,$id_candidat,1,0)";
		$rep=$GLOBALS['connection']->prepare($req);
		$rep->execute();
		echo "Vous vous êtes bien inscrit à l'épreuve !";
	}
	else{
		echo "Vous êtes déjà inscrit à l'épreuve !";
	}
}
?>
</body>
</html>