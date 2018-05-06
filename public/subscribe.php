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

write_header("Guiilde");

include view("subscribe_view.php");

write_foot();