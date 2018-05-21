<?php
include("../src/annonce.php");
include("../src/viewfunctions.php");
include("../src/sidebar.php");

protectAccess();

header_t("Les Bons Bails");

displayResearch();
dispSidebar();
?>

<div class="main">

<?php
$annonces = Annonce::getAnnonces(Annonce::genQuery($_GET));

echo "<h2>Résultats de la recherche</h2>";
Annonce::reduceButton();
foreach ($annonces as $an)
    $an->display();
?>

</div>

<?php
footer();
?>

