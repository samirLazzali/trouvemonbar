<?php           
include("../src/accessdb.php"); 
include("../src/annonce.php"); 

session_start();

$res = false;

if (isset($_SESSION['username']) && isset($_POST['submit']) && ($annonce = Annonce::annonceFromPost($_SESSION['username'])) != null)
    $res = $annonce->sendToDb();

print_r($_POST);
$_POST = array();
$_POST['done'] = $res;
print_r($_POST);

//header("Refresh:0; url=createForm.php");
?>
