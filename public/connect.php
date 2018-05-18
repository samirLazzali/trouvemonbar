<?php
session_start();

require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


function login($connection)
{
    $compteur=0;
    if(empty($_POST['pseudo']) || empty($_POST['mdp']))
    {
	echo "Veuillez remplir les champs";
    }
    else
    {
	$pseudo = $_POST['pseudo'];
	$pwd = $_POST['mdp'];

	$match = $connection->query('SELECT * FROM public.user');
	$res=$match->fetchAll();
	foreach($res as $re){
		if($re['pseudo']==$pseudo && $re['mdp']==$pwd){
			$_SESSION['prenom']=$re['prenom'];
			$_SESSION['nom']=$re['nom'];
			$_SESSION['email']=$re['mail'];
			$_SESSION['pseudo']=$re['pseudo'];
			$_SESSION['mdp']=$re['mdp'];
			$_SESSION['connect']=$re['inscription'];
			header("location:index.php");
		}
	}
	echo "erreur";

}
}


login($connection);

?>

