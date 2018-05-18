<?php
session_start();
require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

session_start();

function login($connection)
{
    $compteur=0;
    if(empty($_POST['pseudo']) || empty($_POST['mdp']))
    {
	return "Veuillez remplir les champs";
    }
    else
    {
	$pseudo = $_POST['pseudo'];
	$pwd = $_POST['password'];

	$match = $connection->query("SELECT * FROM users WHERE pseudo='$pseudo' AND mdp='$pwd'")->fetchAll(\PDO::FETCH_OBJ);

	foreach($match as $entry)
	{
	    return $entry->id;
	}
	return "Informations incorrectes";
	// A FINIR
    }
}

?>

