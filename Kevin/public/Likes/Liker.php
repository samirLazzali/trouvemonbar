<?php
session_start();
require_once '../../vendor/autoload.php';
require_once "../Modele.php";


liker($_GET['T_id'], $_SESSION['id']);

header("Location: ".$_SERVER['HTTP_REFERER']."");


