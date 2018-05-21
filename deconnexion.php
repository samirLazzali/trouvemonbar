<?php
session_start();
session_destroy();
$titre="Déconnexion";
include("includes/debut.php");

if ($id==0) erreur(ERR_IS_NOT_CO);
echo '<p>Cliquez <a href="./index.php">ici</a> pour revenir à la page d accueil</p>';
header("index.php");
exit();