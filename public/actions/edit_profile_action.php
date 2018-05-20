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

if(isset($_POST["gamesystems"]))
    $gamesystems = $_POST["gamesystems"];
else
    $gamesystems = false;


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
    flash(" Pseudo ne peut pas être vide.");
    redirect("../edit_profile.php");
}
if($mail == null)
{
    flash(" E-mail ne peut pas être vide.");
    redirect("../edit_profile.php");
}

//insert each new game system
if($gamesystems !== false) {
    foreach ($gamesystems as $gamesystem) {
        $data = json_decode($gamesystem, true);

        //insert only the ones not already in the db
        if(!$user->masters($data['id'])) {

            if(!User::insertMastery($data['id'], $user->getId()))
                flash("Erreur : un de vos sytème n'a pas pu être ajouté");
        }
        else
            flash("Système : ".$data['name']." est déjà enregistré");
    }
}

//update profile
if($user->updateUser_profile($nick,$firstname,$lastname,$mail,$password))
{
        flash("Profil modifié");
        redirect("../user_profile.php?user=$user->userid");
}
else {
    flash("Erreur : le profile n'a pas pu être changé");
    redirect("../edit_profile.php");


}












