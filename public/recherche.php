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

dispSidebar();
?>

<div class="main">

<?php

if(verif_authent()) { // si le gars est authentified ==>  acces aux offres
    $annonces = Annonce::getAnnonces(Annonce::genQuery($_GET));

    echo "<h2>Résultats de la recherche</h2>";
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

