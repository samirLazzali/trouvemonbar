<!DOCTYPE html>
<html>
<head>
	<title> Nom de l'événement </title>
	<metac charset="utf-8">
	<script src="Evenement_Detaille.js"> </script>
	<link rel="stylesheet" type="text/css" href="Evenement_Detaille.css">
	<link rel="stylesheet" type="text/css" href="main.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	
</head>
<body>
<?php include "upperBar.php" ?>
<center><h1> Votre événement</h1>
     	    <br/><br/>
	    	<h4>  Nom de l'événement  </h4>
	    	<br/>
	    	<h4>  Organisateur :  </h4>
	    	<p> ??? </p>
	    	<br/>
	    	<h4>Nombre de participants : </h4>
	    	<p> ??? </p>
	    	<br/>
	    	<h4> Lieu de l'événement : </h4>
	    	<p> ??? </p>
	    	<br/>
	    	<h4> Prix de la participation :  </h4>
	    	<p> ??? </p>
	    	<br/>
	    	<h4> Description  </h4>
	    	<br/>
	    	<p> <em> Exemple de description </em> </p>
	    	<br/>
	    	<h4> Catégorie : </h4>
	    	<p> ??? </p>
	    	<br/>
	    	<h4> Type de musique : </h4>
	    	<p> ??? </p>
	    	<br/> <br/>
	    	<img src="./images/Apartement.jpg" width="300" height="200" alt="Photo de l'événement">
	    	<br/> <br/>

	    	<form> 
  				<input type="button" value="Je participe">
			</form>
			<p>Vous ne participez pas.</p>
	    	
	    	
	    	
	     </center>
</body>
<end>
	<form id="modif_event">
   		 <a href="./Creer_evenement.php"/>
   		 <input type="button" value="Modifier événement">
  	</form>
  <form id="retour_accueil">
    <a href="./Accueil.php"/>
    <input type="button" value="Revenir à l'accueil">
  </form>
</end>
</html>