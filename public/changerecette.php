<?php
session_start();

include("model.php");
include("menuView.php");

changerecette($_POST['index']);
$index=$_POST['index'];
afficherRecette("menu". $index,$index,$_SESSION['menu'][$index]);

?>