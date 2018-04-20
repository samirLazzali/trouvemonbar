<?php
/**
 * Créé un utilisateur.
 * Méthode : POST
 * Paramètres :
 * - username : le nom d'utilisateur demandé
 * - password : le mot de passe du nouvel utilisateur
 * - email    : l'adresse e-mail du nouvel utilisateur
 * Renvoie :
 * - status = error si le nom d'utilisateur ou l'e-mail est déjà utilisé
 * - status = success, <User sérialisé> sinon
 */


require_once("../../config.php");
require_once("User.php");

if (isset($_POST['username']))
    $username = $_POST['username'];
else
    error_die("username", ERROR_FieldMissing);

if (isset($_POST['password']))
    $password = $_POST['password'];
else
    error_die("password", ERROR_FieldMissing);

if (isset($_POST['email']))
    $email = $_POST['email'];
else
    error_die("email", ERROR_FieldMissing);

// TODO : vérification mot de passe

if(User::emailExists($email))
    error_die("This email is already registered.", ERROR_EmailRegistered);
elseif (User::usernameExists($username))
    error_die("This username is already registered.", ERROR_UsernameRegistered);

$newUser = User::create($username, $email, $password);
success_die($newUser);