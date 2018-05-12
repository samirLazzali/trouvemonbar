<?php
/**
 * Created by PhpStorm.
 * User: KevinXu
 * Date: 12/05/2018
 * Time: 16:32
 */
session_start();
require '../vendor/autoload.php';
require_once 'Vue.php';


enTete("Accueil", "CSS/style.css");

afficheMenu();

$T_id = $_GET['T_id'];
$id_user = $_GET['pseudo_id'];


echo $T_id;
echo $id_user;









