<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    echo (!empty($titre))?'<title>'.$titre.'</title>':'<title> GolrIIE </title>';
    ?>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./css/template.css">
    <link rel="stylesheet" type="text/css" href="./css/relo.css">
</head>
<?php

//Attribution des variables de session
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
include("includes/constant.php");
include("includes/fonctions.php");
?>