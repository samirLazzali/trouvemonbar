<?php
include("../src/annonce.php");
include("../src/viewfunctions.php");
include("../src/sidebar.php");

handleLogin();

header_t("Les Bons Bails");

if(!verif_authent()) { // si le gars est authentified ==>  acces aux offres
    displayLogin();
    print "    <link rel=\"stylesheet\" href=\"css/full.css\">";
} else {
    displayResearch();
    dispSidebar();
}
?>

<div class="main">

<?php

if(verif_authent()) { // si le gars est authentified ==>  acces aux offres

    $annonces = Annonce::getAnnonces();

    echo "<h2>Dernières Annonces</h2>";
    Annonce::reduceButton();
    foreach ($annonces as $an)
	$an->display();

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

