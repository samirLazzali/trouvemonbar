<?php
$nom = $_POST['Nom'];
$prenom = $_POST['Prenom'];
$pseudo = $_POST['Pseudo'];
$mail = $_POST['Mail'];
$tel = $_POST['Tel'];
$mdp = $_POST['password1'];
$mdp2 = $_POST['password2'];

if ((! isset($nom)) | (!isset($prenom))|(!isset($pseudo)) |(! isset($mail)) | (! isset($tel)) |(! isset($mdp)) | (! isset($mdp2))
	|$nom=="" |$prenom == ""|$pseudo == ""|$mail == ""|$tel == ""|$mdp == ""|$mdp2 == ""){   
	echo '<body onLoad="alert(\'un ou plusieurs champ du formulaire n ont pas été complété\')">';
    echo '<meta http-equiv="refresh" content="0;URL=creationUtilisateur.html">';
}
else
{
	$pass_hache = password_hash($mdp, PASSWORD_DEFAULT);   // hashage du mot de passe
	$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	$dbPassword = getenv('DB_PASSWORD');
//    $dbName="postgres";
//    $dbUser="postgres";
//    $dbPassword='123456';
	try
	{
		$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
//        $connection = new PDO("pgsql:host=localhost user=$dbUser dbname=$dbName password=$dbPassword");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if((($connection->query("select count(*) num from Compte where pseudo='$pseudo'"))->fetch())['num']==1)
            {
                $connection=null;
                echo "<script>alert('il y a deja un pseudo qui s\'appelle $pseudo')</script>";
                echo '<meta http-equiv="refresh" content="0;URL=creationUtilisateur.html">';

            }

        $a = $connection->query("SELECT MAX(id_user)+1 FROM Utilisateur");
		$i = $a->fetch();
		$id = $i[0];

        $connection->query("INSERT INTO Compte VALUES ('$pseudo','$pass_hache','$prenom','$nom','$tel','$mail')")===true;

        $connection->query("INSERT INTO Utilisateur VALUES ('$id','$pseudo')")===true;
        
    }catch(Exeption $e){
		die('Erreur : '.$e->getMessage());
	}


//	if($connection->query("INSERT INTO Compte VALUES ('$pseudo','$pass_hache','$prenom','$nom','$tel','$mail')")===true){
//	    echo "success";
//    }else{
//	    echo "$connection->error";
//    }
//    echo "<script>console.log('$s')</script>";
	//	echo "<script>alert('".$s."')</iis_get_script_map(server_instance, virtual_path, script_extension)t>";
//    echo $s;
	session_start();
    $_SESSION['login'] = $pseudo;
    $_SESSION['pwd'] = $mdp;
    $connection=null;
	header ('location: index.php');
}
?>