<?php
require_once("../config.php");

require_once("api.php");

if(isset($_POST['password']) && isset($_POST['username']))
{
    $password = $_POST['password'];
    $username = $_POST['username'];
}
else
    header("Location: login.php");

try {
    $u = User::findWithUsernameOrEmail($username);
}
catch (UserNotFoundException $e)
{
    die("Utilisateur non trouvé : $username");
}

if (User::testPassword($u->getID(), $password))
    authenticate($u);
else
    die("Mauvais mot de passe.");