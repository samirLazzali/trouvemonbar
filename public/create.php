<?php           
include("../src/accessdb.php"); 
include("../src/annonce.php"); 

session_start();

if (isset($_POST['submit']) && ($annonce = Annonce::annonceFromPost($_SESSION['username'])) != null) {
    if ($annonce->sendToDb()) {
	print "Sent !";
    } else {
	print "Returned false";
    }
} else {
    print "Nothing to do.";
}

?>
