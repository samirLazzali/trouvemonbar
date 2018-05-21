<?php
session_start();
session_destroy();
$titre="Déconnexion";
include("includes/debut.php");

if ($id==0) erreur(ERR_IS_NOT_CO);
header("index.php");
exit();