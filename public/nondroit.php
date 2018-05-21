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
    print "<link rel=\"stylesheet\" href=\"css/full.css\">";
} else {
    dispSidebar();

}
//dispSidebar();
?>

<div class="main">
<h2>Accès interdit</h2>
<div class=annonce>
    <!--<div class=title style="text-align:center;"> <strong> Impossible d'acceder à votre demande </strong></div>-->
    <div>
	<br>
	Le contenu que vous essayez de visualiser n'est pas disponible.
	<br><br><br>
	<a href="main.php"><strong> Retour </strong></a>
	<br><br>
    </div>
</div>

</div>

<?php
footer();
?>
