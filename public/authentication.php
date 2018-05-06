<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 24/04/18
 * Time: 15:22
 */

require_once "../src/app/helpers.php";;

if(Auth::logged())
    redirect("index.php");


$layout = new Layout("visitors");
include view("authentication_view.php");
$layout->show('Se connecter');
