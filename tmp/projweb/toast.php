<?php

$pseudo=$_POST['pseudo'];
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];

function affiche_info(){
	$pseudo=$_POST['pseudo'];
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	echo "<p>Prenom :  $prenom \n</p>";
	echo "<p>Pseudo : $pseudo  \n</p>";
	echo "<p>Nom :  $nom  \n</p>";
}

affiche_info();
?>