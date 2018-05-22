<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 17/05/18
 * Time: 22:46
 */
require "../src/app/helpers.php";
if(!Auth::logged())
    redirect("index.php");

try {
    $user = new User($_SESSION['user']);
}
catch(Exception $e)
{
    error_log($e);
}

//list of all gamesystems
$gamesystems = Gamesystem::make_list();
//display view
$layout = new Layout("users");
include view("edit_profile_view.php");
$layout->show("Modifier mon profil");

