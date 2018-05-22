<?php
$identifiant = $_POST['pseudo'];
$mail = $_POST['mail'];

if ((! isset($identifiant)) | (!isset($mail))
	|$identifiant=="" |$mail == ""){   
	echo '<body onLoad="alert(\'un ou plusieurs champ du formulaire n ont pas été complété\')">';
    echo '<meta http-equiv="refresh" content="0;URL==newAd.html">';
}
else
{
//    $dbName="postgres";
//    $dbUser="postgres";
//    $dbPassword='123456';
	$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	$dbPassword = getenv('DB_PASSWORD');

	try{
		$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
//        $connection = new PDO("pgsql:host=localhost user=$dbUser dbname=$dbName password=$dbPassword");

    }
	catch(Exeption $e){
		die('Erreur : ');
	}
	$reponse = $connection->query("SELECT mail FROM compte WHERE pseudo = '$identifiant'");
	$M = $reponse->fetch();
//	echo "<script>alert(123)</script>";
//	echo "<script>console.log(' ".password_hash($mdp, PASSWORD_DEFAULT)."++++++++++++++++and+++++++++++++"
//		.$MDP["mdp"]."')</script>";


	//if ($MDP["mdp"] == password_hash($mdp, PASSWORD_DEFAULT)){  // vérification de l'égalité des deux fonctions hashé
      if($M["mail"]  == $mail){
		$reponse->closeCursor();
		$a = $connection->query("SELECT MAX(id_admin)+1 FROM Administrateur");
		$i= $a->fetch();
		$id = $i[0];
		$connection->query("INSERT INTO Administrateur VALUES ('$id','$identifiant')");
		$connection->query("DELETE FROM Utilisateur WHERE pseudo ='$identifiant' ");
		$connection=null;

    }
    else {
        $reponse->closeCursor();
        $connection=null;
    }
    		header ('location: profil.php');
}

?>