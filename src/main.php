<?php
//include("authentication.php");
include("annonce.php");
include("viewfunctions.php");
include("sidebar.php");

handleLogin();

header_t("Les Bons Bails");

if(!verif_authent()) { // si le gars est authentified ==>  acces aux offres
    displayLogin();
} else {
    displayResearch();
}

dispSidebar();
?>

<div class="main">

<?php

if(verif_authent()) { // si le gars est authentified ==>  acces aux offres
    //indexco();
    $annonces = Annonce::getAnnonces();
    print Annonce::genQuery($_GET);

    //$annonces = getoffers($_GET["semestre"], $_GET["module"], $_GET["matiere"]);
    echo "<h2>Dernières Annonces</h2>";
    foreach ($annonces as $an) {
	$an->display();
    }
} else {	// sinon pas acces aux offres
    indexnotco();
}
?>

</div>

<?php
footer();
?>

