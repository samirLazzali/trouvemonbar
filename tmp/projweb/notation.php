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

$pseudo=$_GET['pseudo'];
$pseudo_jury=$_SESSION['pseudo'];
//On vérifie si la note entrée est bien correcte
function isRatingValid($note){
	global $pseudo;
	if(is_numeric($note)){
		$note=(int)$note;
		if($note>=0 && $note<=20){
			return($note);
		}
		else{
			echo "La note n'est pas entre 0 et 20 ! <br/>";
			$link="noter.php?pseudo=".$pseudo;
			echo "Retour vers la page de <a href=$link> notation </a>";
			return(false);
		}
	}
	else{
		echo "La note n'est pas un format numérique.<br/>";
		$link="noter.php?pseudo=".$pseudo;
		echo "Retour vers la page de <a href=$link> notation </a>";
		return(false);
	}
}
//On vérifie si le jury a déjà noté le candidat pour l'épreuve
function hasAlreadyRated($id_jury,$id_candidat,$id_epreuve){
	$req="SELECT COUNT(*) FROM candidat_epreuve WHERE id_candidat=$id_candidat AND id_jury=$id_jury AND id_epreuve=$id_epreuve";
	$rep=$GLOBALS['connection']->prepare($req);
	$rep->execute();
	$result=$rep->fetch(PDO::FETCH_ASSOC);
	return($result['count']!=0);
}
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
//Retour vers le profil si c'est mal noté
if(!isset($_POST['epreuve']) || !isset($_POST['note'])){
	echo "Vous n'avez pas renseigné d'épreuve ou de note !<br/>";
	$link="profil.php?pseudo=".$pseudo;
	echo "<a href=$link> Retour vers le profil </a>";
}
//Retour vers le profil si c'est un candidat qui essaye de noter un candidat
else if($_SESSION['status']=='candidat'){
	echo "Vous êtes un candidat vous ne pouvez donc pas noter un candidat, n'essayez pas de tricher jeune garçon !<br/>";
	$link="profil.php?pseudo=".$pseudo;
	echo "<a href=$link> Retour vers le profil </a>";
}
//On accepte les données envoyées par le formulaire
else{
	// On récupère la note et le nom de l'épreuve.
	$note=$_POST['note'];
	$epreuve=htmlspecialchars(urldecode($_POST['epreuve']));
	if(isRatingValid($note)){
		//On récupère l'id du jury
		$req="SELECT id_jury FROM jury WHERE pseudo_j=". $GLOBALS['connection']->quote($pseudo_jury)."";
		$rep=$GLOBALS['connection']->prepare($req);
		$rep->execute();
		$result=$rep->fetch(PDO::FETCH_ASSOC);
		$id_jury=$result['id_jury'];
		//On récupère l'id du candidat
		$req="SELECT id_candidat FROM candidat WHERE pseudo_c=". $GLOBALS['connection']->quote($pseudo)."";
		$rep=$GLOBALS['connection']->prepare($req);
		$rep->execute();
		$result=$rep->fetch(PDO::FETCH_ASSOC);
		$id_candidat=$result['id_candidat'];
		//On récupère l'id de l'épreuve
		$req="SELECT id_epreuve FROM epreuve WHERE nom_e=". $GLOBALS['connection']->quote($epreuve)."";
		$rep=$GLOBALS['connection']->prepare($req);
		$rep->execute();
		$result=$rep->fetch(PDO::FETCH_ASSOC);
		$id_epreuve=$result['id_epreuve'];
		//On vérifie si le jury a déja noté le candidat pour l'épreuve.
		if(!hasAlreadyRated($id_jury,$id_candidat,$id_epreuve)){
			// Si ce n'est pas le cas alors on insère la note dans la table candidat_epreuve
			$req="INSERT INTO candidat_epreuve(id_epreuve,id_candidat,id_jury,note) VALUES($id_epreuve,$id_candidat,$id_jury,$note)";
			$rep=$GLOBALS['connection']->prepare($req);
			$rep->execute();
			echo "Votre note a bien été enregistrée ! <br/>";
			echo "Retour vers la <a href=liste.php> liste des candidats </a>";
		}
		//Sinon on update la note
		else{
			$req="UPDATE candidat_epreuve SET note=$note WHERE id_epreuve=$id_epreuve AND id_candidat=$id_candidat AND id_jury=$id_jury";
			$rep=$GLOBALS['connection']->prepare($req);
			$rep->execute();
			echo "Votre note a bien été actualisée ! <br/>";
			echo "Retour vers la <a href=classement.php> liste des candidats </a>";
		}
		
	}
}


?>