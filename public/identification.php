<?php
$identifiant = $_POST['pseudo'];
$mdp = $_POST['password'];
if ((! isset($identifiant)) | $identifiant == "" | ! is_string($identifiant)) {
//	echo '<body onLoad="alert(\'Vous devez impérativement taper un identifiant\')">';
	echo "<script>alert('Vous devez impérativement taper un identifiant')</script>";
    echo '<meta http-equiv="refresh" content="0;URL=identification.html">';
}
elseif ((! isset($mdp)) | $mdp == "" | ! is_string($mdp)) {
	echo '<body onLoad="alert(\'Vous devez impérativement taper un mot de passe\')">';
    echo '<meta http-equiv="refresh" content="0;URL=identification.html">';
}
else{
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
	$reponse = $connection->query("SELECT mdp FROM compte WHERE pseudo = '$identifiant'");
	$MDP = $reponse->fetch();
//	echo "<script>alert(123)</script>";
//	echo "<script>console.log(' ".password_hash($mdp, PASSWORD_DEFAULT)."++++++++++++++++and+++++++++++++"
//		.$MDP["mdp"]."')</script>";


	//if ($MDP["mdp"] == password_hash($mdp, PASSWORD_DEFAULT)){  // vérification de l'égalité des deux fonctions hashé
      if(password_verify($mdp,$MDP["mdp"])){
        session_start();
        $_SESSION['login'] = $identifiant;
		$_SESSION['pwd'] = $mdp;
		$reponse->closeCursor();
		$connection=null;
		header ('location: index.php');
    }
    else {
        $reponse->closeCursor();
        $connection=null;
    	echo '<body onLoad="alert(\'Mauvais mot de passe ou identifiant\')">';
    	echo '<meta http-equiv="refresh" content="0;URL=identification.html">';

    }
}
?>


