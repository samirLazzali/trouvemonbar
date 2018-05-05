<?php

require "../../src/app/helpers.php";

$passwd = $_POST['password'];
$mail = $_POST['email'];

if( !($id = User::check( $mail, $passwd )) )
{
    flash("Mot de passe ou mail erroné.");
    redirect("../authentication.php");
}

Auth::login($id);
Auth::get_user();
redirect("../index.php");