<?php
/**
 * Created by PhpStorm.
 * User: KevinXu
 * Date: 17/05/2018
 * Time: 15:24
 */
session_start();

require '../vendor/autoload.php';
require_once 'Vue.php';

enTete("Déconnexion", "CSS/style.css");
titreH1("Au revoir ".$_SESSION['prénom']);



session_destroy();

?>
