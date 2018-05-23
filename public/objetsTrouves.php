<?php

include("vue.php");
include("config.php");

enTete("Objets trouvés");
page_connect();
page_inscription();
page_accueil();
page_deconnection();

affiche_objTrouves();
pied();

?>

