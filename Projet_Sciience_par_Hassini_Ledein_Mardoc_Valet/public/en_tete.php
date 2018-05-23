<?php
	function en_tete(){
	echo '
	     <!DOCTYPE html>

	     <html lang="fr">
  	     <head>
		<meta charset="utf-8">
    		<link rel="stylesheet", href="fond.css" />
    		<link rel="icone" href="Images/icone.jpg" />
    		<title>Sciience</title>
  	     </head>
  
             <body> 
               <header>';
	
		
     $connected = false;
     if(!$connected){
          echo '<div id="login">
			<div class="elementLogin"><a href = "inscription.php"> S\'inscrire </a> </div>	
			<div class="elementLogin"><a href = "connection.php"> Se connecter </a> </div>
		</div>';
     }else{
	  echo '<div id="login">
			<div class="elementLogin"><a href = "profil.php"> Profil </a> </div>
			<div class="elementLogin"><a href = "deconnection.php"> Se déconnecter </a> </div>
		</div>';
     }

      echo '
		<h1>Sciience</h1>
      		<h3>"Les grands esprits se rencontrent"</h3>	
      
     		<div id="menu">
	
			<div style="background-color: red;" class="elementMenu"><a href = "index.php"> Accueil </a> </div>
			<div style="background-color: orange;" class="elementMenu"><a href = "actualites.php"> Actualités </a> </div>
			<div style="background-color: yellow;" class="elementMenu"> <a href = "bibliotheque.php"> Bibliothèque </a> </div>
			<div style="background-color: #00FF00;" class="elementMenu"> <a href = "evenements.php"> Evènements </a> </div>
			<div style="background-color: purple;" class="elementMenu"><a href = "partenariat.php"> Partenaires </a> </div>
			<div style="background-color: #1E90FF;" class="elementMenu"> <a href = "Forum/forum.php"> Forum </a> </div>
			<div style="background-color: grey;" class="elementMenu"> <a href = "contact.php"> Contact </a> </div>
	
     		</div>
      	      </header>

  	      <div id="coeur">
      	   	<nav>
	  	 <h3>Rubrique</h3>
	   		<ul>
			   <li><a href="Rubrique/astronomie.php">Astronomie</a></li>
	  		   <li><a href="Rubrique/algebre.php">Algèbre</a></li>
	  		   <li><a href="Rubrique/analyse.php">Analyse</a></li>
	  		   <li><a href="Rubrique/cryptographie.php">Cryptographie</a></li>
	  		   <li><a href="Rubrique/informatique.php">Informatique</a></li>
	  		</ul>

	   	<h3>Diffusion d\'article</h3>
	   		<ul>
			   <li><a href="Diffusion_article/maths.php">Mathématiques</a></li>
	  		   <li><a href="Diffusion_article/physique.php">Physique</a></li>
	  		   <li><a href="Diffusion_article/autres.php">Autres</a></li>
	  		</ul>

	   	<h3>Exposé</h3>
	   		<ul>
			   <li><a href="Expose/merkle.php">Chiffrement de Merkle-Hellman</a></li>
	  		   <li><a href="Expose/chladni.php">Les figures de Chladni</a></li>
	  		   <li><a href="Expose/courbes_elliptiques.php">Les courbes elliptiques</a></li>
 	  	 	</ul>

	   	<h3>Projet</h3>
	   		<ul>
			   <li><a href="#">Acheter des choses</a></li>
	  		   <li><a href="#">Manger des choses</a></li>
	  		   <li><a href="#">Dormir</a></li>
	  		</ul>
	       </nav>';
}
