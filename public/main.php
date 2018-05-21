<?php
include("../src/annonce.php");
include("../src/viewfunctions.php");
include("../src/sidebar.php");

handleLogin();

header_t("Les Bons Bails");

if(!verif_authent()) { // si le gars est authentified ==>  acces aux offres
    displayLogin();
} else {
    displayResearch();
}
if(verif_authent()) {
    dispSidebar();
} else {
    print "    <link rel=\"stylesheet\" href=\"css/full.css\">";
}
?>

<div class="main">

<?php

if(verif_authent()) { // si le gars est authentified ==>  acces aux offres
    //indexco();
    $annonces = Annonce::getAnnonces();
    print Annonce::genQuery($_GET);

    //$annonces = getoffers($_GET["semestre"], $_GET["module"], $_GET["matiere"]);
    echo "<h2>Dernières Annonces</h2>";
    Annonce::reduceButton();
    foreach ($annonces as $an) {
	$an->display();
    }
} else {	// sinon pas acces aux offres
    if (isset($_POST['error'])) {
	indexnotco($_POST['error']);
    } else {
	indexnotco();
    }
}
?>

</div>

<?php
footer();
?>

