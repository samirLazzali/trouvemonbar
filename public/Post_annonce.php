<?php
include("vue.php");
include("config.php");
session_start();

enTete("Post d'annonce");
page_accueil();
page_connect();
page_inscription();
page_profil();

page_deconnection();
affiche_post();
pied();

?>