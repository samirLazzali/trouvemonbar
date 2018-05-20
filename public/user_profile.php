<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 24/04/18
 * Time: 15:22
 *
 * This page is used by a user to review his own profile, or to check another's user public profile
 */
require "../src/app/helpers.php";

if(!Auth::logged())
    redirect("index.php");

try {
    $user = new User($_GET['user']);
}
catch(Exception $e)
{

}
$games = $user->gm_for();
$participations = $user->pc_for();
$systems = $user->hisSystems();
$isOwner = $user->getId() == $_SESSION['user'];

$layout = new Layout("users");
include view("user_profile_view.php");
$layout->show("Profil de ".$user->getNick());




