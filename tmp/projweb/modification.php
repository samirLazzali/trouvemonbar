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
$pseudo=$_SESSION['pseudo'];
$target_dir="../pics/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//On vérifie les données du fichier uploadé

if(strlen($_FILES["fileToUpload"]["name"])!=0){
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        echo "Le fichier est une image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "Le fichier n'est pas une image<br/>";
	        $uploadOk = 0;
	    }
	}
	if (file_exists($target_file)) {
	    echo "Le fichier existe déjà, essayez de le renommer<br/>";
	    $uploadOk = 0;
	}
	if ($_FILES["fileToUpload"]["size"] > 5000000) {
	    echo "Taille du fichier trop grande<br/>";
	    $uploadOk = 0;
	}
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Le format de l'image n'est pas bon<br/>";
	    $uploadOk = 0;
	}
	if ($uploadOk == 0) {
	    echo "Le fichier n'a pas été upload.<br/>";
	// On essaye d'upload
	} else {
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	        echo "Le fichier ". basename( $_FILES["fileToUpload"]["name"]). " a bien été upload.<br/>";
	        $req="SELECT photo FROM candidat WHERE pseudo_c=". $GLOBALS['connection']->quote($pseudo) ."";
	        $rep=$GLOBALS['connection']->prepare($req);
	        $rep->execute();
	        $res=$rep->fetch(PDO::FETCH_ASSOC);
	        $lastPhoto=$res['photo'];
	        echo "<br/>";
	        //L'utilisateur n'a pas encore uploadé de photo
	        if(strlen($lastPhoto)==1){
	        	$photoName=$_FILES['fileToUpload']['name'];
	        	$req="UPDATE candidat SET photo=". $GLOBALS['connection']->quote($photoName) ." WHERE pseudo_c=". $GLOBALS['connection']->quote($pseudo) ."";
				$rep=$GLOBALS['connection']->prepare($req);
	        	$rep->execute();
	        }
	        //Sinon on supprime son ancienne photo
	        else{
	        	$link="../pics/".$lastPhoto;
	        	unlink($link);
	        	$photoName=$_FILES['fileToUpload']['name'];
	        	$req="UPDATE candidat SET photo=". $GLOBALS['connection']->quote($photoName) ." WHERE pseudo_c=". $GLOBALS['connection']->quote($pseudo) ."";
				$rep=$GLOBALS['connection']->prepare($req);
	        	$rep->execute();
	        	echo "Retour vers la <a href='main.html'>page principale</a>";
	        }
	    } 
	    else {
	        echo "Erreur lors de l'upload de l'image <br/>";
	        echo "Retour vers la <a href='main.html'>page principale</a>";
	    }
	}
}
//On modifie la description
$description=htmlspecialchars($_POST['description']);

if(strlen($description)<500 && strlen($description)>2){
	$req="UPDATE candidat SET description=". $GLOBALS['connection']->quote($description) ." WHERE pseudo_c=". $GLOBALS['connection']->quote($pseudo) ."";
	$rep=$GLOBALS['connection']->prepare($req);
	$rep->execute();
	echo "Votre description a bien été modifiée.<br/>";

}

else if(!(strlen($description)<500 && strlen($description)>2) && strlen($description)!=0){
	echo "<br/>Description trop longue (500 caractères maximum) ou trop courte";
	echo "Retour vers la <a href='main.html'>page principale</a>";

}


?>

