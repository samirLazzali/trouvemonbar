<?php 
session_start();
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$GLOBALS['dbName']=$dbName;
$GLOBALS['dbUser']=$dbUser;
$GLOBALS['dbPassword']=$dbPassword;
$GLOBALS['connection']=$connection;
//Cette fonction renvoie true si le nom passé en argument est présent dans la table des épreuves 
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
//Cette fonction vérifie que les champs sont bien remplis
function isInsertValid($description,$nom){
	return(strlen($description)<1000 && strlen($nom)<50 && strlen($nom)>0 && strlen($description)>0);
}

if(isset($_POST['date']) && isset($_POST['description']) && isset($_POST['name']) && isset($_SESSION['status']) && $_SESSION['status']=='admin' && isset($_POST['nom'])){
	$nom=htmlspecialchars(urldecode($_POST['nom']));
	$date=htmlspecialchars($_POST['date']);
	$description=htmlspecialchars($_POST['description']);
	$name=htmlspecialchars($_POST['name']);
	if(isInsertValid($description,$name)){
		$req="UPDATE epreuve SET description_e=". $GLOBALS['connection']->quote($description) .",nom_e=". $GLOBALS['connection']->quote($name) .",date_e=". $GLOBALS['connection']->quote($date) ." WHERE nom_e=". $GLOBALS['connection']->quote($nom) ."";
		$rep=$GLOBALS['connection']->prepare($req);
	    $rep->execute();
	    echo "L'épreuve a bien été modifiée<br/>";
		echo "Retour vers la page d'<a href='administration.php'>administration</a>";
	}
	else{
		echo "Problème lors du remplissage du formulaire<br/>";
		echo "Retour vers la page d'<a href='administration.php'>administration</a>";
	}
}
else if(isset($_GET['nom']) && exist_epreuve(htmlspecialchars(urldecode($_GET['nom']))) && isset($_SESSION['status']) && $_SESSION['status']=='admin'){
	$nom=htmlspecialchars(urldecode($_GET['nom']));
	$req="SELECT description_e,date_e FROM epreuve WHERE nom_e=". $GLOBALS['connection']->quote($nom) ."";
	$rep=$GLOBALS['connection']->prepare($req);
	$rep->execute();
	$res=$rep->fetch(PDO::FETCH_ASSOC);
	$description=$res['description_e'];
	$date=$res['date_e'];
	echo "<form method='post' action='modifEpreuve.php'>";
	echo "Nom de l'épreuve (50 caractères max)<br/>";
	echo "<textarea name='name' id='name'>";
	echo $nom;
	echo "</textarea><br />";
	echo "Description de l'épreuve (1000 caractères max)";
	echo "<br/>";
	echo "<textarea name='description' id='description'>";
	echo $description;
	$nom=urlencode($nom);
	echo "</textarea><br />";
	echo "Date de l'épreuve <br/>";
	echo "<input type='date' name='date' value=$date /><br/>";
	echo "<input type='submit' name='sub' />";
	echo "<input type='hidden' name='nom' value=$nom />";
	echo "</form>";
}
else{
	echo "Cette épreuve n'existe pas ou alors vous ne disposez pas des droits suffisants.<br/>";
	echo "Retour à la page d'<a href=administration.php>administration</a><br/>";
	echo "Retour à la page de <a href=login.html>login</a><br/>";
}

?>
