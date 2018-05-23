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

$pseudo=$_POST['pseudo'];
$mdp=$_POST['pwd'];	
$status=$_POST['status'];

$GLOBALS['connection']->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$GLOBALS['connection']->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

switch($status){
	case("candidat"):
		$req="SELECT mdp_c FROM candidat WHERE pseudo_c=". $GLOBALS['connection']->quote($pseudo)."";
		$rep=$GLOBALS['connection']->prepare($req);
		$rep->execute();
		$result=$rep->fetch(PDO::FETCH_ASSOC);
		if($result['mdp_c']==$mdp){
			echo "Login Success";
			$_SESSION['pseudo']=$pseudo;
			$_SESSION['status']=$status;

		}
		else{
			echo "Login Failed <br/>";
			echo "<a href='login.html'> Retour vers la page de login </a><br/>";
			echo "<a href='Inscription.html'> Aller à la page d'Inscription </a>";
		}
		break;
	case("jury"):
		$req="SELECT mdp_j FROM jury WHERE pseudo_j=". $GLOBALS['connection']->quote($pseudo)."";
		$rep=$GLOBALS['connection']->prepare($req);
		$rep->execute();
		$result=$rep->fetch(PDO::FETCH_ASSOC);
		if($result['mdp_j']==$mdp){
			echo "Login Success";
			$_SESSION['pseudo']=$pseudo;
			$_SESSION['status']=$status;
		}
		else{
			echo "Login Failed <br/>";
			echo "<a href='login.html'> Retour vers la page de login </a><br/>";
			echo "<a href='Inscription.html'> Aller à la page d'Inscription </a>";
		}
		break;
	case("admin"):
		$req="SELECT mdp_a FROM admin WHERE pseudo_a=". $GLOBALS['connection']->quote($pseudo)."";
		$rep=$GLOBALS['connection']->prepare($req);
		$rep->execute();
		$result=$rep->fetch(PDO::FETCH_ASSOC);
		if($result['mdp_a']==$mdp){
			echo "Login Success";
			$_SESSION['pseudo']=$pseudo;
			$_SESSION['status']=$status;
		}
		else{
			echo "Login Failed <br/>";
			echo "<a href='login.html'> Retour vers la page de login </a><br/>";
			echo "<a href='Inscription.html'> Aller à la page d'Inscription </a>";
		}
		break;
}

?>

<?php 
echo "<br/><a href='liste.php'> Liste des candidats </a><br/>";
echo "<a href='epreuves.php'> Liste des épreuves </a><br/>";
?>