<?php
//include("authentication.php");
include("viewfunctions.php");
include("annonce.php");
include("sidebar.php");
login();

header_t("Les Bons Bails");
if(!verif_authent()) { // si le gars est authentified ==>  acces aux offres
    displayLogin();
}

dispSidebar();
?>

<div class="main">

<?php

if(verif_authent()) { // si le gars est authentified ==>  acces aux offres
    //indexco();
/*    $_GET["module"]
    $_GET["semestre"]
    $_GET["matiere"]*/
    //$annonces = Annonce::getAnnonces();
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

