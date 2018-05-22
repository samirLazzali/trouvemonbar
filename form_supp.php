<?php 
session_start();
?>

<html>
<head> <h1> Ajout d'une série </h1></head>
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

<body>
<p>Veuillez rentrer l'id du livre a supprimer.</p>

<form action="res_supp.php" method="POST">
<input type="text" name="id" value="id">
<input type="submit" name="valider" value="valider"></br>
</form>

<a href="profil.php">Retour au profil.</a>

</body>

</html>