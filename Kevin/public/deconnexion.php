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

enTeteConnexion("Deconnexion","CSS/style.css");
echo '<h1>Au revoir '.$_SESSION['login'].'</h1>';



session_destroy();

?>
