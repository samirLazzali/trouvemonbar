<?php
include("vue.php");
include("config.php");

enTete("Boutique");
page_connect();
page_inscription();
page_accueil();
page_deconnection();
affiche_boutique();
pied();

?>