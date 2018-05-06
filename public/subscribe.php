<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 02/05/18
 * Time: 00:20
 */

require "../src/app/helpers.php";

if(Auth::logged())
    redirect("index.php");


$layout = new Layout("visitors");
include view("subscribe_view.php");
$layout->show("S'inscrire");