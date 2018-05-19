<?php require '../src/accessdb.php';

$SIZEREQUETE= "SELECT COUNT(*) FROM annonce";
$CONNEXION = dbConnect();
$SIZE = dbQuery($CONNEXION, $SIZEREQUETE)+1;
$REQUETE = "INSERT INTO annonce VALUES ($SIZE,op?? jsp quoi mettre,$_POST['annoncesemester'],$_POST['annoncemodule'],$_POST['annoncegenre']
,$_POST['annoncetitle'],$_POST['annoncedesc'],$_POST['annoncepayamount'],$_POST['annonceswapnature'], false)";

?>