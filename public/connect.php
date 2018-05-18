<?php
session_start();
<<<<<<< HEAD

=======
>>>>>>> b29d501e2d675f3759931434148b4622d26db271
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
			header("location:index.php");
		}
	}
	echo "erreur";

}
}

login($connection);

?>

