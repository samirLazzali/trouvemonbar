<?php
/**
 * Created by PhpStorm.
 * User: KevinXu
 * Date: 16/05/2018
 * Time: 18:43
 */
session_start();
require_once '../../vendor/autoload.php';
require_once "../Modele.php";

$T_id = $_POST['idTweet'];

deleteTweet($T_id);

header("Location: ../accueil.php");

