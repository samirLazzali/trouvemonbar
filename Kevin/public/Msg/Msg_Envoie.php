<?php
session_start();

require_once '../../vendor/autoload.php';
require_once '../Modele.php';

ajoutMessage($_GET['m'], $_GET['recepteur'], $_SESSION['id'])

?>


