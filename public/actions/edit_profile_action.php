<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 18/05/2018
 * Time: 21:56
 */
require "../../src/app/helpers.php";

if(!Auth::logged()) redirect("../edit_profile.php");

if(isset($_POST["password"]))
    $password = htmlspecialchars($_POST["password"]);
else
    $password = false;

if(isset($_POST["gamesystem"]))
    $gamesystemid = $_POST["gamesystem"];
else
    $gamesystemid = false;

$mail= htmlspecialchars($_POST["mail"]);
$nick= htmlspecialchars($_POST["nick"]);
$lastname= htmlspecialchars($_POST["lastname"]);
$firstname= htmlspecialchars($_POST["firstname"]);
$password= htmlspecialchars($_POST['password']);

try {
    $user = new User($_GET['userid']);
}
catch(Exception $e)
{

}

if($nick == null)
{
    flash(" Pseudo ne peut pas être vide!!!");
    redirect("../edit_profile.php");
}
if($mail == null)
{
    flash(" E-mail ne peut pas être vide!!!");
    redirect("../edit_profile.php");
}


$masterylist=User::masterylist($user->getId());

if($gamesystemid == false)
    User::deleteMastery($user->getId());
else
{
    if(count($masterylist) !== count($gamesystemid))
        User::deleteMastery($user->getId());
    foreach ($gamesystemid as $gamesystem)
    {
        $user::insertMastery($gamesystem,$user->getId());
    }
}

if($user->updateUser_profile($nick,$firstname,$lastname,$mail,$password))
{
        flash(" réussir à changer votre profile ");
        Auth::logout();
        redirect("../authentication.php");
}
else {
    flash("Erreur : le profile n'a pas pu être changé");
    redirect("../edit_profile.php");


}



