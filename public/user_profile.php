<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 24/04/18
 * Time: 15:22
 *
 * This page is used by a user to review his own profile, or to check another's user public profile
 * @todo display a user profile (the user's id is passed via get method
 */
require "../src/app/helpers.php";

if(!Auth::logged())
    redirect("index.php");


 // lire_infos_utilisateur() est défini dans ~/models/user.php
try {
    $user = new User($_GET['user']);
}
catch(Exception $e)
{

}

$layout = new Layout("users");
include view("user_profile_view.php");
$layout->show("Profil de ".$user->getNick());




