<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 20/05/18
 * Time: 17:49
 */
require "../src/app/helpers.php";
if(Auth::logged())
    redirect("index.php");

$layout = new Layout("visitors");
include view("forget_mdp_view.php");
$layout->show("Réinitialiser le mot de passe");