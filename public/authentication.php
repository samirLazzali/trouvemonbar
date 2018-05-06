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

write_header("Se connecter");

include view("authentication_view.php");
write_foot();