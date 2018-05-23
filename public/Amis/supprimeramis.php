<?php
session_start();
require '../../vendor/autoload.php';
require_once '../Modele.php';

$id1 = $_POST['personne']; 
$id2 = $_SESSION['id'];
$pseudo = loginUserID($id1);
supprimeramis($id2,$id1);
header("Location: ../profil.php?pseudo=$pseudo&id=$id1");

