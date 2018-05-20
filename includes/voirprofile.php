<?php
session_start();
$titre="Profil";
include("includes/id.php");
include("includes/debut.php");
//On récupère la valeur de nos variables passées par URL
$action = isset($_GET['action'])?htmlspecialchars($_GET['action']):'consulter';
$membre = isset($_GET['m'])?(int) $_GET['m']:'';

echo $membre;
echo $action;