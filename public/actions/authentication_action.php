<?php

require "../../src/app/helpers.php";

$passwd = htmlspecialchars($_POST['password']);
$mail = htmlspecialchars($_POST['email']);

if( !($id = User::check( $mail, $passwd )) )
{
    flash("Mot de passe ou mail erroné.");
    redirect("../authentication.php");
}

Auth::login($id);
Auth::get_user();
redirect("../index.php");