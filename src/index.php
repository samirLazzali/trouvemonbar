<?php
//include("authentication.php");
include("viewfunctions.php");
include("annonce.php");
login();

header_t("Bienvenue sur le site des bons bails");

displayLogin();
?>

<div class=main>

<?php
if(verif_authent()) { // si le gars est authentified ==>  acces aux offres
    //indexco();
    $username = $_SESSION['username'];
    echo "You are logged in, $username!";
    print "<h2>Dernières annonces</h2>";
    $annonces = Annonce::getAnnonces();
    foreach ($annonces as $an) {
	$an->display();
    }
} else {	// sinon pas acces aux offres
    print "You are logged out !";
    indexnotco();
}
?>

</div>

<?php
footer();
$_POST = array();
?>

