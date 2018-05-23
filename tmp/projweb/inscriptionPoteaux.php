<?php 
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$GLOBALS['dbName']=$dbName;
$GLOBALS['dbUser']=$dbUser;
$GLOBALS['dbPassword']=$dbPassword;
$GLOBALS['connection']=$connection;

$pseudo=$_POST['pseudo'];
$mdp=$_POST['pwd'];	

$GLOBALS['connection']->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$GLOBALS['connection']->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

$req="SELECT * FROM candidat WHERE pseudo_c=". $GLOBALS['connection']->quote($pseudo)."";
$rep=$GLOBALS['connection']->prepare($req);
$rep->execute();
$result=$rep->fetch(PDO::FETCH_ASSOC);
$id_candidat=$result['id_candidat'];

function exist_candidat_inCE($id){
	$sql_select="SELECT COUNT(*) FROM candidat_epreuve WHERE id_candidat=$id";
	$rep=$GLOBALS['connection']->prepare($sql_select);
	$rep->execute();
	$result=$rep->fetch(PDO::FETCH_ASSOC);
	if($result['count']!=0)
		return true;
	else{
		return false;
	}
}


if($result['mdp_c']==$mdp){ //succès lors de la connexion
	if(!exist_candidat_inCE($id_candidat)){
		$req="INSERT INTO candidat_epreuve(id_epreuve,id_candidat,id_jury,note) VALUES(1,$id_candidat,1,0)";
		$rep=$GLOBALS['connection']->prepare($req);
		$rep->execute();
		echo "Vous vous êtes bien inscrit à l'épreuve !";
	}
	else{
		echo "Vous êtes déjà inscrit à l'épreuve !";
	}
}
else{
	echo "Problème lors de la connexion.";
}
?>