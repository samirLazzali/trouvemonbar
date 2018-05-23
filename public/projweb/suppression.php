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
//On vérifie si c'est bien l'admin qui est sur la page
if(isset($_SESSION['status'])&& $_SESSION['status']=='admin'){
	//On vérifie que l'url est correcte
	if(isset($_GET['pseudo']) && isset($_GET['status'])){
		$pseudo=htmlspecialchars($_GET['pseudo']);
		$status=htmlspecialchars($_GET['status']);
		//On supprime si c'est un candidat
		if($status=='candidat'){
			$req="SELECT id_candidat,photo FROM candidat WHERE pseudo_c=". $GLOBALS['connection']->quote($pseudo) ."";
			$rep=$GLOBALS['connection']->prepare($req);
			$rep->execute();
			$result=$rep->fetch(PDO::FETCH_ASSOC);
			$id=$result['id_candidat'];
			if(strlen($result['photo'])!=1){
				$link="../pics/".$result['photo'];
				unlink($link);
			}
			$req="DELETE FROM candidat_epreuve WHERE id_candidat=$id";
			$rep=$GLOBALS['connection']->prepare($req);
			$rep->execute();

			$req="DELETE FROM candidat WHERE id_candidat=$id";
			$rep=$GLOBALS['connection']->prepare($req);
			$rep->execute();
			echo "Le candidat ".$pseudo." a bien été supprimé.<br/>";
			echo "Retour à la page d'<a href=administration.php>administration</a>";
		}
		//On supprime si c'est un jury
		else if($status=='jury'){
			$req="SELECT id_jury FROM jury WHERE pseudo_j=". $GLOBALS['connection']->quote($pseudo) ."";
			$rep=$GLOBALS['connection']->prepare($req);
			$rep->execute();
			$result=$rep->fetch(PDO::FETCH_ASSOC);
			$id=$result['id_jury'];

			$req="DELETE FROM candidat_epreuve WHERE id_jury=$id";
			$rep=$GLOBALS['connection']->prepare($req);
			$rep->execute();

			$req="DELETE FROM jury WHERE id_jury=$id";
			$rep=$GLOBALS['connection']->prepare($req);
			$rep->execute();
			echo "Le jury ".$pseudo." a bien été supprimé ainsi que ses notes fournies.<br/>";
			echo "Retour à la page d'<a href=administration.php>administration</a><br/>";
		}
	}
	//Si c'est une épreuve
	else if(isset($_GET['nom'])){
		$nom=urldecode(htmlspecialchars($_GET['nom']));
		//On récupère l'id de l'épreuve
		$req="SELECT id_epreuve FROM epreuve WHERE nom_e=". $GLOBALS['connection']->quote($nom) ."";
		$rep=$GLOBALS['connection']->prepare($req);
		$rep->execute();
		$res=$rep->fetch(PDO::FETCH_ASSOC);
		$id_e=$res['id_epreuve'];
		//On supprime les données en commençant par candidat_epreuve
		$req="DELETE FROM candidat_epreuve WHERE id_epreuve=$id_e";
		$rep=$GLOBALS['connection']->prepare($req);
		$rep->execute();
		$req="DELETE FROM epreuve WHERE nom_e=". $GLOBALS['connection']->quote($nom) ."";
		$rep=$GLOBALS['connection']->prepare($req);
		$rep->execute();
		echo "L'épreuve a bien été supprimée <br/>";
		echo "Retour à la page d'<a href=administration.php>administration</a><br/>";
		
	}
	else{
		echo "ERREUR<br/>";
		echo "Retour à la page d'<a href=administration.php>administration</a><br/>";
	}
}
else{
	echo "Vous ne disposez pas des droits suffisants<br/>";
	echo "Retour à la page d'<a href=administration.php>administration</a><br/>";
}
?>