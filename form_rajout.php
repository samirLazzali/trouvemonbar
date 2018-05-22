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
<p>Veuillez remplir le formulaire d'ajout de livre dans la base de donnée.</p>

<form action="res_rajout.php" method="POST">

<table class = "forml">
<tr>
<td>Titre :</td> 
<td>
<input type="text" size="40" name="titre"/></td>
</tr></table>

<table class = "forml">
<tr>
<td>Auteur :</td> 
<td>
<input type="text" size="40" name="auteur"/></td>
</tr></table>

<table class = "forml">
<tr>
<td>Edition :</td> 
<td>
<input type="text" size="40" name="edition"/></td>
</tr></table>

<table class = "forml">
<tr>
<td>Date de parution Y/M/D:</td> 
<td>
<input type="text" size="40" name="date_de_parution"/></td>
</tr></table>

<table class = "forml">
<tr>
<td>sorte (manga, bd, ou roman):</td> 
<td>
<input type="text" size="40" name="sorte"/></td>
</tr></table>

<table class = "forml">
<tr>
<td>serie :</td> 
<td>
<input type="text" size="40" name="serie"/></td>
</tr></table>


<table class = "forml">
<tr>
<td>Tome :</td> 
<td>
<input type="text" size="40" name="tome"/></td>
</tr></table>

<table class = "forml">
<tr>
<td>Langue :</td> 
<td>
<input type="text" size="40" name="langue"/></td>
</tr></table>

<table class = "forml">
<tr>
<td>Résumé :</td> 
<td>
<input type="text" size="40" name="resume" /></td>
</tr></table>

<table class = "forml">
<tr>
<td>Dessinateur (dans le cas des mangas ou bd):</td> 
<td>
<input type="text" size="40" name="dessinateur" /></td>
</tr></table>

<table class = "forml">
<tr>
<td>Tag n°1 :</td> 
<td>
<input type="text" size="40" name="tag1" /></td>
</tr></table>

<table class = "forml">
<tr>
<td>Tag n°2 (facultatif):</td> 
<td>
<input type="text" size="40" name="tag2" /></td>
</tr></table>

<table class = "forml">
<tr>
<td>Tag n°3 (facultatif):</td> 
<td>
<input type="text" size="40" name="tag3" /></td>
</tr></table>

<input type="submit" name="valider" value="valider"></br>
</form>




</body>

</html>