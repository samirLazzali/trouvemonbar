


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
<center><h2> Faites profiter les autres en créant votre évènement !</h2>
     	    <br/><br/>
	     <form action="Creer_evenement.php" method="post" id="event">
	     	   <label for="nom_event"><b>Nom de l'évènement</b></label>
		   <br/>
	     	   <input type="text" name="nom_event" required/>
		   <br/>
		   <br/>
		   <label for="date_event"><b>Quand?</b></label>
		   <br/>
		   <input type="date" name="date_event" required>
		   <br/>
		   <label for="lieu_event"><b>Où?</b></label>
		   <br/>
		   <input type="text" name="lieu_event" required>
		   <br/>
		   <br/>
		   <label for="before"><b>Quel before chacal?<br/></b><label/>
		   <input type="text" name="before" required>
		   <br></br>
		   <label for="prix"><b>Et ça coûte combien?<br/></b><label/>
		   <br/>
		   <input type="text" name="prix" required>
		   <br></br><br>
		   <label for="image"><b> Une petite photo de l'endroit?<br/></b><label/>
		   <br/>
		   <input type="file" name="image">
		   <br/>
		   <br/>
		   <input type="submit" value="Validez vos informations">
		   </form>
		   
		   
		   
	
	     
	     
</center>
</body>
</html>
