<?php 

include("index.php");

$pseudo=$_POST['pseudo'];
$prenom=$_POST['prenom'];
$nom=$_POST['nom'];
$sexe=$_POST['id_sexe'];
$is_full=0;
$GLOBALS['n']=20;
/*
function get_idSexuelle(){
	if isset
}*/
function affiche_info(){
	$pseudo=$_POST['pseudo'];
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$sexe=$_POST['id_sexe'];
	echo "<p>Prenom :  $prenom \n</p>";
	echo "<p>Pseudo : $pseudo  \n</p>";
	echo "<p>Nom :  $nom  \n</p>";
	echo "<p>Identité sexuelle : $sexe \n</p>";
}

function print_alert(){
	echo "<script>";
	echo 'alert("Vous navez pas correctement rempli les informations !");';
	echo "</script>";
}

$bool = (empty($pseudo) || empty($nom) || empty($prenom)); // Si au moins un des champs n'est pas rempli par l'utilisateur alors on actualise la page
if (empty($pseudo) || empty($nom) || empty($prenom)){
	echo "<script type='text/javascript'> document.location.replace('Inscription.html');</script>";
}
//Sinon on récupère les valeurs fournies par le fomulaire et on insère
else{
	$pseudo=$_POST['pseudo'];
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$sexe=$_POST['id_sexe'];
	if($sexe=="Autre"){
		echo '<form method="post" action="inscriptionAutre.php"> Voulez vous participer en tant que candidat ou jury ? : <input type="radio" name="id_sexe" value="Homme" id="homme" checked="checked" /> <label for="homme">Candidat</label>
        <input type="radio" name="id_sexe" value="Femme" id="femme" /> <label for="femme">Jury</label><br/><input type="submit" value="Valider"/></form>';
        $sexe=$_POST['id_sexe'];
	}
	if($sexe=="Homme"){			//Candidat
		$n=$GLOBALS['n'];
		$req=$GLOBALS['dbName']->prepare("INSERT INTO 'candidat'(id_candidat,prenom_c,nom_c,pseudo_c) VALUES($n,$pseudo, $nom,$prenom)");
		$rep=$GLOBALS['dbName']->exec($req);
	}
	else{		//Jury
		$n=$GLOBALS['n'];
		$req=$GLOBALS['dbName']->prepare("INSERT INTO 'jury'(id_jury,prenom_j,nom_j,pseudo_j) VALUES($n,$pseudo, $nom,$prenom)");
		$rep=$GLOBALS['dbName']->exec($req);
	}
	$GLOBALS['n']=$GLOBALS['n']+1;
}


?>