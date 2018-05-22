<?php
$nom = $_POST['nom2'];
$description = $_POST['description2'];
$urli = $_POST['URLI2'];
$adresse = $_POST['adresse2'];
$tel = $_POST['tel2'];
$ville = $_POST['ville2'];
$url = $_POST['URL2'];
$prix = $_POST['prix2'];
$horaire = $_POST['horaire'];
$nMax = $_POST['Pmax'];
$nMin = $_POST['Pmin'];
$duree = $_POST['duree'];
echo $horaire.$nMin.$nMax.$duree;
if (!isset($_POST['R2'])){
	$R = 'false';
} else {
	$R = 'true';
}
if (isset($_POST['Culture']) | isset($_POST['Sport'])){

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
		echo $a == false;
		$i= $a->fetch();
		$id = $i[0];	
		$connection->query("INSERT INTO Entreprise VALUES ('$id','$adresse','$ville','$url','$tel','$R','$prix','$urli')");
		if (isset($_POST['Culture'])){
			$connection->query("INSERT INTO Activite_culturelle VALUES ('$id','$nom','$description','$duree','$horaire','$nMin','$nMax')");
			//header ('location: index.php');
		}
		else if (isset($_POST['Sport'])){
			$connection->query("INSERT INTO Activite_sportive VALUES ('$id','$nom','$description','$horaire','$nMax','$nMin')");
			//header ('location: index.php');
		}
	}
}
else {
	echo '<body onLoad="alert(\'vous devez choisir aumoins un type d activité\')">';
	    echo '<meta http-equiv="refresh" content="0;URL=creationAct.php">';
}
?>