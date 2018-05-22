<?php 
session_start(); 
?>
<!DOCTYPE html>
<html>




<head>
	<style type="text/css">
		body{
			font-family: "Lato", sans-serif;

		}

		ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 100%;
            position: fixed;
            top: 0;
            background-color: #f1f1f1;
        }
        .g {
            float: left;
        }
        .d {
            float: right;
        }
        li a {
            display: block;
            color: #000;
            padding: 8px 16px;
            text-decoration: none;
        }

        /* Change the link color on hover */
        li a:hover {
            background-color: #555;
            color: white;
        }
        li a.active {
            background-color: #4CAF50;
            color: white;
        }
		input{
			margin-right: 30px;
			margin-left: 30px;
			margin-bottom: 30px;
			width: 190px;
		}
		input[type=text], select, textarea {
			width: 100%;
			padding: 12px;
			border: 1px solid #ccc;
			margin-top: 16px;
			margin-bottom: 0px;
			resize: vertical;
		}

		input[type=submit] {
			background-color: #4CAF50;
			color: white;
			padding: 12px 20px;
			border: none;
			cursor: pointer;
			font-size: 20px;
			text-align: center;

		}

		input[type=number] {
			width: 39%;
			padding: 12px;
			border: 1px solid #ccc;
			margin-top: 16px;
			margin-bottom: 0px;
			resize: vertical;

		}

		input[type=submit]:hover {
			background-color: #45a049;
		}
		h2{
			margin-top: 7%;
			text-align: center;
			font-size: 40px;
		}

		.creation{
			padding-top: 30px ;
			width: 850px;
			margin:auto;
		}
		.envoi{
			margin-top: 40px;
			text-align: center;
		}
	p{
		height: 1px;
		color: red;
	}

	</style>
</head>
<body>
	<div>
	    <ul>
	        <li class = "g" style="font-family: Lato, sans-serif"><a href="index.php#accueil">Accueil</a></li>
	        <li class = "g" style="font-family: Lato, sans-serif"><a href="index.php#Recherche">Recherche</a></li>
	        <li class = "g" style="font-family: Lato, sans-serif"><a href="index.php#contact">Contact</a></li>
	        <li class = "g" style="font-family: Lato, sans-serif"><a class="active" href="index.php#about">Nous</a></li>


	        <?php
	        if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
	            echo '<li class = "d">';
	            echo '<a href="./logout.php" style="font-family: Lato, sans-serif">Déconnexion</a>';
	            echo '</li>';
	            echo '<li class = "d">';
	            echo '<a href="./profil.php" style="font-family: Lato, sans-serif">'.$_SESSION['login'].'</a>';
	            echo '</li>';
	        }
	        else {
	            echo '<li class = "d">';
	            echo '<a href="./creationUtilisateur.html" style="font-family: Lato, sans-serif">Création</a>';
	            echo '</li>';            
	            echo '<li class = "d">';
	            echo '<a class = "active" href="./identification.html" style="font-family: Lato, sans-serif">Identification</a>';
	            echo '</li>';
	        }
	        ?>

	    </ul>
	</div>


	<h2>Proposer un nouveau restaurant!</h2>
	<form action="creationRest.php" method="post">
		<div class= "creation">
        <input type="text" name="nom" placeholder = "nom" id="nom" onblur="veriftext(this)" />
        <input type="text" name="description" placeholder = "description" id="description" onblur="veriftext(this)" />
        <input type="text" name="URLI" placeholder = "url d'une image" id="URLI" onblur="verifurl(this)" />
        <input type="text" name="adresse" placeholder = "adresse" id="adresse" onblur="veriftext(this)" />
        <input type="text" name="ville" placeholder = "ville" id="ville" onblur="veriftext(this)" />
        <input type="text" name="tel" placeholder = "telephone" id="tel" onblur="verifTel(this)" />
        <input type="text" name="URL" placeholder = "site web" id="URL" onblur="verifturl(this)" /><br><br>
        <label for="prix" style="margin-left: 30px"> Prix moyen </label>
		<select name="prix" id="prix" style="margin-left: 30px">
			<option value="0">gratuit</option>
           	<option value="10">&lt 10</option>
           	<option value="20">20</option>
           	<option value="30">20-30</option>
           	<option value="40">30-40</option>
           	<option value="50">40-50</option>
           	<option value="60">&gt 50 </option></br>
       	</select>
       	<br><br>
       	<input type="checkbox" name="R" placeholder= "Réservation" id="R"/>Réservation
		</br>
	</div>
	<div class = "envoi">
		
		<input id = "sub" type="submit" value="Créer" />
	</div>
	</form>



	<h2>Proposer une nouvelle activité!</h2>
	<form action="creationActivite.php" method="post">
		<div class = "creation">
		<input type="radio" name="Culture" placeholder= "Culture" id="Culture"/>Activité Culturelle
		<input type="radio" name="Sport" placeholder= "Sport" id="Sport"/>Activité Sportive
        <input type="text" name="nom2" placeholder = "nom" id="nom2" onblur="veriftext(this)"/>
		<input type="text" name="duree" placeholder = "durée (en heure)" id="duree" onblur="verifHor(this)"/><br><br>
		<label for="horaire" style="margin-left: 30px"> Plage horaire </label>
		<select name="horaire" id="horaire" style="margin-left: 30px;">
			<option value="journee">journée</option>
        	<option value="soir">soir</option>
       	</select><br><br>
		<input type="number" name="Pmin" placeholder = "nombre de personne maximum" id="Pmin"/>
		<input type="number" name="Pmax" placeholder = "nombre de personne minimum" id="Pmax"  />
        <input type="text" name="description2" placeholder = "description" id="description2"onblur="veriftext(this)"  />
        <input type="text" name="URLI2" placeholder = "url d'une image" id="URLI2"onblur="verifurl(this)" />
        <input type="text" name="adresse2" placeholder = "adresse" id="adresse2" onblur="veriftext(this)"/>
        <input type="text" name="ville2" placeholder = "ville" id="ville2"onblur="veriftext(this)"/>
        <input type="text" name="tel2" placeholder = "telephone" id="tel2"onblur="veriftext(this)"/>
        <input type="text" name="URL2" placeholder = "site web" id="URL2" onblur="verifurl(this)"/><br><br>
        <label for="prix2" style="margin-left: 30px;"> Prix moyen </label><br />
		<select name="prix2" id="prix2" style="margin-left: 30px;">
			<option value="0">gratuit</option>
           	<option value="10">&lt 10</option>
           	<option value="20">10-20</option>
           	<option value="30">20-30</option>
           	<option value="40">30-40</option>
           	<option value="50">40-50</option>
           	<option value="60">&gt 50 </option>
       	</select><br><br>
       	<input type="checkbox" name="R2" placeholder= "Réservation" id="R2"/>Réservation
		</br>
	</div>
	<div class = "envoi">
		
		<input id = "sub" type="submit" value="Créer" />
	</div>
	<div style="height: 100px;">
		
	</div>
	</form>
</body>
</html>




<script type="text/javascript">
function surligne(champ, erreur)
{
   if(erreur)
      champ.style.borderColor = "red";
   else
      champ.style.borderColor = "";
}

function veriftext(champ)
{

   	if(champ.value.length < 2 || champ.value.length > 50)
   	{
   		document.getElementById('E'+champ.name).innerHTML = "Votre "+champ.name+" doit faire entre 2 et 50 caractères";
    	surligne(champ, true);
    	document.getElementById('sub').setAttribute("disabled","true");
      	return false;
   	}
   	else
   	{
   		document.getElementById('E'+champ.name).innerHTML = "";
      	surligne(champ, false);
      	document.getElementById('sub').removeAttribute("disabled");
      	return true;
   	}
}

function verifTel(champ)
{
	var tel = parseInt(champ.value);
   	if(champ.value.length != 10 || isNaN(tel))
   	{
   		document.getElementById('ETel').innerHTML = "Entrez un numero de telephone valide";
    	surligne(champ, true);
    	document.getElementById('sub').setAttribute("disabled","true");
      	return false;
   	}
   	else
   	{
   		document.getElementById('ETel').innerHTML = "";
      	surligne(champ, false);
      	document.getElementById('sub').removeAttribute("disabled");
      	return true;
   	}
}


function verifMail(champ)
{
	var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{1,10}$/;
   	if(!regex.test(champ.value))
   	{
      	surligne(champ, true);
      	document.getElementById('sub').setAttribute("disabled","true");
      	return false;
   	}
   	else
   	{
      	surligne(champ, false);
      	document.getElementById('sub').removeAttribute("disabled");
      	return true;
   	}
}

function verifurl(champ)
{
	var regex = /^(?:https:\/\/)?(?:([\w-]+)\.)?([\w-]+)\.([\w]+)\/?(?:([^?#$]+))?(?:\?([^#$]+))?(?:#(.*))?$/;
   	if(!regex.test(champ.value))
   	{
      	surligne(champ, true);
      	document.getElementById('sub').setAttribute("disabled","true");
      	return false;
   	}
   	else
   	{
      	surligne(champ, false);
      	document.getElementById('sub').removeAttribute("disabled");
      	return true;
   	}
}
function verifHor(champ)
{
	var tel = parseInt(champ.value);
   	if(champ.value.length <3 || isNaN(tel))
   	{
    	surligne(champ, true);
    	document.getElementById('sub').setAttribute("disabled","true");
      	return false;
   	}
   	else
   	{
      	surligne(champ, false);
      	document.getElementById('sub').removeAttribute("disabled");
      	return true;
   	}
}


</script>