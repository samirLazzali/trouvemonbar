<?php

session_start();
$_SESSION['id_produit'] = $_POST['id_produit'];
$_SESSION['quantite'] = $_POST['quantite'];

header ('location: Ensemble_de_Produit.php');


?>