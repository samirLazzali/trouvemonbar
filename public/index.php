<?php
session_start();

include("vue.php");
include("config.php");

enTete("AMAZONIIE");

if (!isset($_SESSION["mail"])){
    page_connect();
    page_inscription();
}
else {
    page_profil();
    page_deconnection();
    page_crud();
}

affiche_menu();
pied();