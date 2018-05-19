<?php
//include("authentication.php");
include("../src/viewfunctions.php");
include("../src/annonce.php");
include("../src/sidebar.php");
login();

header_t("Les Bons Bails");
if(!verif_authent()) { // si le gars est authentified ==>  acces aux offres
    displayLogin();
}
if(verif_authent())
{
	dispSidebar();

}
//dispSidebar();
if(verif_authent()) 
{
	contactsuccess();
}
else {
	contactfailure();
}

footer();
?>