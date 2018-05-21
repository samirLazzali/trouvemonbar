<?php
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
?>

<div class="main">

<h2></h2>

<div class=annonce>
	<div class=title>À propos</div>
	<div> 
		<br>
		Fondé en 2018, <strong>Les Bons Bails</strong> est un <strong> site d'annonces intra-ENSIIE</strong>. Il s'adresse uniquement aux étudiants de l'ensiie. Dans un soucis de confidentialité, seuls nos membres sont autorisés à visualiser les annonces. 
		<br>
		<br>
		Nous rappelons à l'ensemble de la communauté pédagogique de l'ENSIIE que l'objectif principal de notre site est de favoriser le partage de connaissances et la réutilisation de milliers de lignes de code.
		Nous rappelons également à l'ensemble de nos membres que Les Bons Bails ne saurait être porté responsable de vos actes. Libre à vous de choisir de réutiliser un fichier identique, ou d'y mettre votre touche personnelle.
		<br>
		<br>
	</div>
</div>

</div>

<?php
footer();
?>
