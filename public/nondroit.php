<?php
//include("authentication.php");
include("../src/viewfunctions.php");
include("../src/annonce.php");
include("../src/sidebar.php");
session_start();
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
?>

<div class="main">

<div class=annonce>
	<div class=title style="text-align:center;"> <strong> Impossible d'acceder à votre demande </strong>
	</div>
	<div> 
		<br>
		Le contenu que vous essayez de visualiser n'est pas disponible.
		<br>
		<br>
		Vous n'y avez pas droit d'accès.
		<br>
		<a href="main.php"><strong> Retour </strong></a>
		<br>
	</div>
</div>

</div>

<?php
footer();
?>
