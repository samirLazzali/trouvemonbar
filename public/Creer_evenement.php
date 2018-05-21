<?php
session_start();
require '../vendor/autoload.php'; 
//postgres 
$dbName = getenv('DB_NAME'); 
$dbUser = getenv('DB_USER'); 
$dbPassword = getenv('DB_PASSWORD'); 
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$userRepository = new \User\UserRepository($connection);
if (!empty($_POST)){
	$userRepository->creer_evenement($_POST['nom_event'],$_POST['date_event'],$_POST['lieu_event'],$_POST['before'],$_POST['prix'],$_POST['image'],$_POST['description']);
}

?>



<!DOCTYPE html>
<html>
<head>
	<title> Créez votre évènement !  </title>
	<metac charset="utf-8">
	<link rel="stylesheet" type="text/css" href="Creer_evenement.css">
	<link rel="stylesheet" type="text/css" href="main.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	
</head>
<body>
<?php include "upperBar.php" ?>
<center><h2><em> Faites profiter les autres en créant votre évènement !</em></h2>
     	    <br/><br/>
	     <form action="Creer_evenement.php" method="post" id="event">
	     	   <label for="nom_event"><b>Nom de l'évènement</b></label>
		   <br/>
	     	   <input type="text" class="events" name="nom_event" style="width:100%;"required/>
		   <br/>
		   <br/>
		   <label for="description"><b>Une petite description ?</b></label>
		   
		   <textarea name="description" cols="35" rows="3"></textarea>
		   <br/>
		   <label for="date_event"><b>Quand?</b></label>
		   <br/>
		   <input type="date" class="events"  name="date_event" required>
		   <br/>
		   <label for="lieu_event"><b>Où?</b></label>
		   <br/>
		   <input type="text" class="events" name="lieu_event" style="width=100%;" required>
		   <br/>
		   <br/>
		   <label for="before"><b>Quel before chacal?<br/></b></label>
		   <input type="text" class="events" name="before" style="width:100%;" >
		   <br></br>
		   <label for="prix"><b>Et ça coûte combien?<br/></b></label>
		   <br/>
		   <input type="text" name="prix" required>
		   <br></br><br>
		   <label for="image"><b> Une petite photo de l'endroit?<br/></b></label>
		   <br/>
		   <input type="file" name="image">
		   <br/>
		   <br/>
		   <input type="submit" value="Validez vos informations">
	     </form>
	     </center>
</body>
<end>
  <form id="retour_accueil">
    <a href="./Accueil.php"/>
    <input type="button" value="Revenir à l'accueil">
  </form>
</end>
</html>
