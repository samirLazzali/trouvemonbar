<?php
include("Vue.php");
include ("db.php");


$user=$_POST['user'];
$mdp=$_POST['mdp'];
$pseudo=$_POST['pseudo'];
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];

$db=db_connect();
$res=db_query($db,"SELECT identifiant FROM \"projet_bda\".\"Personne\";");
db_fetch($res);
$count=db_count($res)+1;

db_query($db,"INSERT INTO \"projet_bda\".\"Personne\" (nom, prenom,identifiant)
VALUES ( '$nom', '$prenom','$count');");
db_query($db,"INSERT INTO \"projet_bda\".\"Eleve\" (pseudo, id_eleve, mdp,droits,\"Personne_identifiant\")
VALUES ( '$pseudo', '$user', '$mdp',0,$count);");

db_close($res);

affiche_info("Vous avez été enregistré '$pseudo'.");
affiche_info("Bienvenue!");


$_SESSION['pseudo']=$pseudo;
$_SESSION['user']=$user;
$_SESSION['droits']=0;

print "<a href=\"index.php\">Menu</a><br/>\n";