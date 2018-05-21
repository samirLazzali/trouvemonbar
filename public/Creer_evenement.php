<?php session_start(); ?>


<!DOCTYPE html>
<html>
<head>
	<title> Créez votre évènement !  </title>
	<metac charset="utf-8">
	<link rel="stylesheet" type="text/css" href="Creer_evenement.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	
</head>
<body>
<?php include "upperBar.php" ?>
<center><h2 style="font-style: italic;">Faites profiter les autres en créant votre évènement !</h2>
     	    <br/><br/>
	     <form action="Accueil.php" method="post" id="event">
	     	   <label for="nom_event" style="margin-left: 15px"><b>Nom de l'évènement</b></label>
		   <br/>
	     	   <input type="text" class="events form-control" name="nom" style="width:100%;"required />
		   <br/>
		   <label for="date_event" style="margin-left: 15px"><b>Quand?</b></label>
		   <br/>
		   <input type="date" class="events form-control"  name="date" placeholder="AAAA-MM-JJ" required>
		   <br/>
		   <label for="lieu_event" style="margin-left: 15px"><b>Où?</b></label>
		   <br/>
		   <input type="text" class="events form-control" name="lieu" style="width=100%;" required>
		   <br/>

		   <label for="lieu_before" style="margin-left: 15px"><b>Quel before chacal?<br/></b></label>
		   <input type="text" class="events form-control" name="before" style="width:100%;" >
		   <br>
		   <label for="prix" style="margin-left: 15px"><b>Et ça coûte combien?<br/></b></label>
		   <br/>
		   <input type="text" name="prix" class="form-control" required>
		   <br>

		   <label for="description" style="margin-left: 15px"><b>Détails sur l'évènement</b></label>
		   <br/>
		   <textarea class="events form-control" name="description" placeholder="Ajouter des détails" style="height: 120px"></textarea>
		   <br>

		   <label for="image" style="margin-left: 15px"><b> Une petite photo de l'endroit?<br/></b></label>
		   <br><br>
		   <input type="file" name="image">
		   <br/>
		   <br/>
		   	<input type="submit" value="Validez vos informations" name = "creer_evenement">

		   
		   <input type="hidden" name="organisateur" value="<?= isset($_SESSION['id']) ? $_SESSION['id'] : 1 ?>">
	     </form>
	     </center>
</body>
<end>
  <form id="retour_accueil">
    <input type="button" value="Revenir à l'accueil" onclick="
    if (confirm('Voulez-vous vraiment abandonner la création de cet évènement ?')) {
    window.location.href = 'Accueil.php';
}">
  </form>
</end>
</html>
