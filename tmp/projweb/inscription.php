



<?php 
//include("index.php");
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$GLOBALS['dbName']=$dbName;
$GLOBALS['dbUser']=$dbUser;
$GLOBALS['dbPassword']=$dbPassword;
$GLOBALS['connection']=$connection;

$pseudo=$_POST['pseudo'];
$prenom=$_POST['prenom'];
$nom=$_POST['nom'];
$sexe=$_POST['id_sexe'];
$mdp=$_POST['pwd'];	

// Fonction qui génère une clé primaire pour un statut d'individu particulier.
// Status doit prendre 3 valeurs : "C"(andidat) "J"(ury) et "A"(dmin).
function get_pkey($status){
	switch ($status){
		case "J":
			$req="SELECT MAX(id_jury) FROM jury";
			$rep=$GLOBALS['connection']->prepare($req);
			$rep->execute();
			$result=$rep->fetch(PDO::FETCH_ASSOC);
			return($result['max']+1);
			break;
		case "C":
			$req="SELECT MAX(id_candidat) FROM candidat";
			$rep=$GLOBALS['connection']->prepare($req);
			$rep->execute();
			$result=$rep->fetch(PDO::FETCH_ASSOC);
			return($result['max']+1);
			break;
		case "A":
			$req="SELECT MAX(id_admin) FROM admin";
			$rep=$GLOBALS['connection']->prepare($req);
			$rep->execute();
			$result=$rep->fetch(PDO::FETCH_ASSOC);
			return($result['max']+1);
			break;
	}	
}
//On vérifie si le candidat de pseudo $pseudo existe
function exist_candidat($pseudo){
	$sql_select="SELECT COUNT(*) FROM candidat WHERE candidat.pseudo_c=". $GLOBALS['connection']->quote($pseudo)."";
	$rep=$GLOBALS['connection']->prepare($sql_select);
	$rep->execute();
	$result=$rep->fetch(PDO::FETCH_ASSOC);
	if($result['count']!=0)
		return true;
	else{
		return false;
	}
}
//Pareil pour Jury
function exist_jury($pseudo){
	$sql_select="SELECT * FROM jury WHERE pseudo_j=".$GLOBALS['connection']->quote($pseudo)."";
	$rep=$GLOBALS['connection']->prepare($sql_select);
	$rep->execute();
	$result=$rep->fetch(PDO::FETCH_ASSOC);
	if(count($result['id_jury'])!=0)
		return true;
	else{
		return false;
	}
}
//Pareil pour Admin
function exist_admin($pseudo){
	$sql_select="SELECT COUNT(*) FROM admin WHERE admin.pseudo_a=". $GLOBALS['connection']->quote($pseudo)."";
	$rep=$GLOBALS['connection']->prepare($sql_select);
	$rep->execute();
	$result=$rep->fetch(PDO::FETCH_ASSOC);
	if($result['count']!=0)
		return true;
	else{
		return false;
	}
}

echo "<br/>";

echo "<br/>";

// Fonction qui permet d'inserer un individu dans la base de données.
// Status définit le type d'individu : Jury (J), Candidat (C), Admin(A).

function insert($prenom,$nom,$pseudo,$status,$mdp){
	$GLOBALS['connection']->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$GLOBALS['connection']->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	switch($status){
		case "J":
			if(!exist_jury($pseudo)){
				$pkey=get_pkey("J");
				$req="INSERT INTO jury(id_jury,prenom_j,nom_j,pseudo_j,mdp_j) VALUES($pkey,". $GLOBALS['connection']->quote($prenom) .",". $GLOBALS['connection']->quote($nom) . ",". $GLOBALS['connection']->quote($pseudo) . ",". $GLOBALS['connection']->quote($mdp) . ")";
				$prepared=$GLOBALS['connection']->prepare($req);
				$rep=$GLOBALS['connection']->exec($req);
				echo "Inscription OK<br/>";
				echo "Retour vers la <a href='main.html'>page principale</a>";
			}
			else{
				echo "Pseudo déjà utilisé, déso<br/>";
				echo "Retour vers la <a href='main.html'>page principale</a>";
				return false;
			}
			break;
		case "C":
			if(!exist_candidat($pseudo)){
				$pkey=get_pkey("C");
				$req="INSERT INTO candidat(id_candidat,prenom_c,nom_c,pseudo_c,mdp_c) VALUES($pkey,". $GLOBALS['connection']->quote($prenom) .",". $GLOBALS['connection']->quote($nom) . ",". $GLOBALS['connection']->quote($pseudo) . ",". $GLOBALS['connection']->quote($mdp) . ")";
				$prepared=$GLOBALS['connection']->prepare($req);
				$rep=$GLOBALS['connection']->exec($req);
				echo "Inscription OK<br/>";
				echo "Retour vers la <a href='main.html'>page principale</a>";
			}
			else{
				echo "Pseudo déjà utilisé, déso<br/>";
				echo "Retour vers la <a href='main.html'>page principale</a>";
				return false;
			}
			break;
		case "A":
			if(!exist_admin($pseudo)){
				$pkey=get_pkey("A");
				$req="INSERT INTO admin(id_admin,prenom_a,nom_a,pseudo_a,mdp_a) VALUES($pkey,". $GLOBALS['connection']->quote($prenom) .",". $GLOBALS['connection']->quote($nom) . ",". $GLOBALS['connection']->quote($pseudo) . ",". $GLOBALS['connection']->quote($mdp) . ")";
				$prepared=$GLOBALS['connection']->prepare($req);
				$rep=$GLOBALS['connection']->exec($req);
				echo "Inscription OK<br/>";
				echo "Retour vers la <a href='main.html'>page principale</a>";
			}
			else{
				echo "Pseudo déjà utilisé, déso<br/>";
				echo "Retour vers la <a href='main.html'>page principale</a>";
				return false;
			}
			break;
		default:
			return false;
			break;
	}
}

if (empty($pseudo) || empty($nom) || empty($prenom)){
	echo "Remplissez bien vos formulaires<br/>";
	echo "Retour vers la page d'<a href='Inscription.html'>inscription </a>";
}


else{
	$pseudo=htmlspecialchars($_POST['pseudo']);
	$prenom=htmlspecialchars($_POST['prenom']);
	$nom=htmlspecialchars($_POST['nom']);
	$sexe=htmlspecialchars($_POST['id_sexe']);
	$mdp=htmlspecialchars($_POST['pwd']);	
	//Site inclusif, on laisse le choix à ses indentités sexuelles minoritaires entre être jury et candidat. 
	if($sexe=="Autre"){
		echo "<form method='post' action='inscription.php'> Voulez vous participer en tant que candidat ou jury ? : <input type='radio' name='id_sexe' value='Homme' id='homme' checked='checked' /> <label for='homme'>Candidat</label>
        <input type='radio' name='id_sexe' value='Femme' id='femme' /> <label for='femme'>Jury</label><br/><input type='submit' value='Valider'/><input type='hidden' name='pseudo' value=$pseudo /><input type='hidden' name='prenom' value=$prenom /><input type='hidden' name='nom' value=$nom /><input type='hidden' name='pseudo' value=$pseudo /><input type='hidden' name='pwd' value=$mdp /></form>";
        $sexe=$_POST['id_sexe'];
	}
	else if($sexe=="Homme"){			//Candidat
		if($GLOBALS['connection']){
			insert($prenom,$nom,$pseudo,"C",$mdp);
		}
		else{
			echo "Erreur dans la connexion à la base de données<br/>";
		}
	}
	else{		//Jury
		if($GLOBALS['connection']){
			insert($prenom,$nom,$pseudo,"J",$mdp);
		}
		else{
			echo "Erreur dans la connexion à la base de données<br/>";
		}
	}
}

?>