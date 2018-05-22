<?php
$nom = $_POST['nom'];
$description = $_POST['description'];
$urli = $_POST['URLI'];
$adresse = $_POST['adresse'];
$tel = $_POST['tel'];
$ville = $_POST['ville'];
$url = $_POST['URL'];
$prix = $_POST['prix'];
if (!isset($_POST['R'])){
	$R = 'false';
} else {
	$R = 'true';
}
if ((! isset($nom)) | (!isset($description))|(!isset($urli)) |(! isset($adresse)) | (! isset($tel)) |(! isset($ville)) | (! isset($url)) | (! isset($prix))
	|$nom=="" |$description == ""|$urli == ""|$adresse == ""|$tel == ""|$ville == ""|$url == "" |$prix == ""){   
	echo '<body onLoad="alert(\'un ou plusieurs champ du formulaire n ont pas été complété\')">';
    echo '<meta http-equiv="refresh" content="0;URL=creationAct.php">';
}
else
{
	$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	$dbPassword = getenv('DB_PASSWORD');
	try
	{
		$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
	}
	catch(Exeption $e){
		die('Erreur : ');
	}
	$a = $connection->query("SELECT MAX(id_ent)+1 FROM Entreprise");
	$i= $a->fetch();
	$id = $i[0];
	$connection->query("INSERT INTO Restaurant VALUES ('$id','$nom','$description')");
	$connection->query("INSERT INTO Entreprise VALUES ('$id','$adresse','$ville','$url','$tel','$R','$prix','$urli')");
	header ('location: index.php');
}
?>