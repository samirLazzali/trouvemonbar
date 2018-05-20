<?php
//include("authentication.php");
include("../src/viewfunctions.php");
include("../src/annonce.php");
include("../src/sidebar.php");

protectAccess();

header_t("Les Bons Bails");

if (!verif_authent()) { // si le gars est authentified ==>  acces aux offres
    displayLogin();
} else {
    dispSidebar();
}

contactsuccess();

footer();
?>
