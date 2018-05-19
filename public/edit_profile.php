<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 17/05/18
 * Time: 22:46
 * @todo option to edit password, mail, games that you can GM for
 */
require "../src/app/helpers.php";
if(!Auth::logged())
    redirect("index.php");

try {
    $user = new User($_SESSION['user']);
}
catch(Exception $e)
{

}
//display view
$layout = new Layout("users");
include view("edit_profile_view.php");
$layout->show("edit profile ");

