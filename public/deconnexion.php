<?php

session_start();
include('vue.php');
include('config.php');

enTete('Déconnection');
page_accueil();

if (!isset($_SESSION["mail"]))
{
    affiche_erreur('Tu n\'es pas connecté(e)');
}
else {
    session_unset();
    echo '<p align = "center" class="succes"> Tu es à présent déconnecté(e) <br /></p> ';
}

pied();

?>