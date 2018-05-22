<?php

/* Ce fichier correspond à la page d'acceuil du site.*/

include("pageAccueil.php");

enTeteAccueil("Tales of Tiny Adventurers");

autentifier();


fin_enTete();

print "<div class='page'>";
images() ;
video();
print "</div>";

pied();
?>