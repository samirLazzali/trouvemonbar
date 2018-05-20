<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 18/05/2018
 * Time: 21:56
 */
require "../../src/app/helpers.php";

if(!Auth::logged()) redirect("../edit_profile.php");

$mail= htmlspecialchars($_POST['mail']);
$password= htmlspecialchars($_POST['password']);

try {
    $user = new User($_GET['userid']);
}
catch(Exception $e)
{

}
if($user->updateUser($password,$mail))
{
    flash(" réussir à changer mot de passe et email ");
    Auth::logout();
    redirect("../authentication.php");


}
flash("Erreur : le profile n'a pas pu être changé");
redirect("../edit_profile.php");


