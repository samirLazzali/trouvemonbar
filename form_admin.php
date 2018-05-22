<?php 
session_start();
?>

<html>
<head> <title> Don des droits d'admin </title></head>
<link rel="stylesheet" href="recherche.css" type="text/css">
<header style="border: 2px solid black;margin: auto;padding: 3px;text-align: right;">
<img src="books.jpg" alt="books" style="height:50px; float:left">
<p style="float:left;"> Local 31<p>
 <nav>
    <ul style="list-style-type : none">
    <li style="display:inline;padding: 0 2em;"><a href="deconnexion.php">Déconnexion</a></li>
	<li style="display:inline;padding: 0 2em;"> <a href="profil.php">Mon profil</a></li>
    </ul>
	
 </nav>
</header>
<link rel="stylesheet" href="recherche.css" type="text/css">
<link rel="stylesheet" href="recherche.css" type="text/css">

<body>
<p>A qui voulez vous donner les droits d'administrateur?</p>

<form action="res_admin.php" method="POST">
<input type="text" name="newAdmin">
<input type="submit" name="valider" value="valider">
</form>

<a href="profil.php">Retour au profil.</a>

</body>

</html>