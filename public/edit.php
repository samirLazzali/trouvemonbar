<?php           
include("../src/accessdb.php"); 
include("../src/annonce.php"); 

$oldAnnonce = Annonce::getAnnonceById($_GET['edit']);

if (isset($_POST['submit'])) {
    $newAnnonce = Annonce::annonceFromPost($oldAnnonce->op);
    $newAnnonce->id = $oldAnnonce->id;
    $newAnnonce->date = $oldAnnonce->date;
    $res = $newAnnonce->updateDb();
} else {
    Tags::resetTags($oldAnnonce->id);
    Annonce::delAnnonceById($oldAnnonce->id);
}

$_POST = array();

header("Refresh:0; url=main.php");
?>
