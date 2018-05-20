<?php
//include("authentication.php");
include("annonce.php");
include("viewfunctions.php");
include("sidebar.php");

session_start();

handleLogin();

header_t("Les Bons Bails");
displayResearch();
if(!verif_authent()) { // si le gars est authentified ==>  acces aux offres
    displayLogin();
}

dispSidebar();
?>

<div class="main">

<?php

if(verif_authent()) { // si le gars est authentified ==>  acces aux offres
    //indexco();
    $annonces = Annonce::getAnnonces();
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

