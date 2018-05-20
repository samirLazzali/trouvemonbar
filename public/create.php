<?php           
include("../src/accessdb.php"); 
include("../src/annonce.php"); 

session_start();

$res = false;

if (isset($_SESSION['username']) && isset($_POST['submit']) && ($annonce = Annonce::annonceFromPost($_SESSION['username'])) != null)
    $res = $annonce->sendToDb();

$_POST = array();

$value = ($res ? 'true' : 'false');
header("Refresh:0; url=createForm.php?done=$value");
?>
