<?php 
session_start();

?>

<html>
<head> <h1> Changer de mot de passe </h1></head>
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
<p>Entrez votre mot de passe et votre ancien mot de passe.</p>

<form action="res_psw.php" method="POST">
<p>Ancien mot de passe.</p><input type="password" name="ancien_password"></br>
<p>Nouveau mot de passe.</p><input type="password" name="password"></br>
<input type="submit" name="valider" value="valider"></br>
</form>

</body>

</html>