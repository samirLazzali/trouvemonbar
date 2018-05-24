<?php
;
include("Vue.php");
include ("db.php");
include ("entete.php");

bandeau();
enTete("Vous êtes inscrits");

$user=$_SESSION['user'];
$sortie=$_POST['id_sortie'];
$db=db_connect();
$res=db_query($db,"INSERT INTO \"projet_bda\".\"Eleve_participe_Sortie\"(\"Eleve_id_eleve\", \"Sortie_id_sortie\") VALUES ('$user','$sortie');");
?>