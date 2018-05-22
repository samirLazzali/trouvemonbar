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
<p>Veuillez remplir le formulaire d'ajout de série dans la base de donnée.</p>


<form action="res_ajout_serie.php" method="POST">

<table class = "forml">
<tr>
<td>Titre :</td> 
<td>
<input type="text" size="40" name="nom_serie"/></td>
</tr></table>

<table class = "forml">
<tr>
<td>nombre de tomes :</td> 
<td>
<input type="text" size="40" name="nb_tomes"/></td>
</tr></table>

<table class = "forml">
<tr>
<td>Auteur :</td> 
<td>
<input type="text" size="40" name="auteur"/></td>
</tr></table>

<table class = "forml">
<tr>
<td>Résumé :</td> 
<td>
<input type="text" size="40" name="resume"/></td>
</tr></table>

<table class = "forml">
<tr>
<td>Tags :</td> 
<td>
<input type="text" size="40" name="tag"/></td>
</tr></table>

<input type="submit" name="valider" value="valider"></br>

</form>



</body>

</html>