<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 02/05/18
 * Time: 10:11
 * @todo : find if this should be in public or src
 */


require "../../src/app/helpers.php";


$password = htmlspecialchars($_POST["password"]);
$nick = htmlspecialchars($_POST["nick"]);
$mail = htmlspecialchars($_POST["mail"]);

//cas où l'insertion échoué
if( ($id = User::insertUser($nick, $password, $mail)) !== false)
{
    //cas où l'insertion réussie
    Auth::login($id);
    redirect("../index.php");
}

flash("Erreur : l'utilisateur n'a pas pu être inséré");
redirect("../subscribe.php");
