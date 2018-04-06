<?php

require_once("../../config.php");
require_once("User.php");

if (isset($_POST['username']))
    $username = $_POST['username'];
else
    error_die("Missing field 'username'.");

if (isset($_POST['password']))
    $password = $_POST['password'];
else
    error_die("Missing field 'password'.");

if (isset($_POST['email']))
    $email = $_POST['email'];
else
    error_die("Missing field 'email'.");

// TODO : vérification mot de passe

if(User::emailExists($email))
    error_die("This email is already registered.");
elseif (User::usernameExists($username))
    error_die("This username is already registered.");

$newUser = User::create($username, $email, $password);
success_die($newUser);