<?php
/**
 * Modifie les informations de l'utilisateur courant.
 * Méthode : POST
 * Paramètres :
 * - username    : le nouveau nom d'utilisateur
 * - email       : la nouvelle adresse e-mail
 * - newpassword : le nouveau mot de passe
 * - password    : le mot de passe actuel
 * Renvoie :
 * - status = error si
 *    - le nouveau nom d'utilisateur est déjà utilisé
 *    - le nouvel e-mail est déjà enregistré
 *    - l'ancien mot de passe est incorrect
 * - status = success sinon
 */

require_once("../../config.php");
require_once("User.php");

$u = verify_logged_in();

if (isset($_POST['username']))
    $newUsername = $_POST['username'];
else
    $newUsername = null;

if (isset($_POST['email']))
    $newEmail = $_POST['email'];
else
    $newEmail = null;

if (isset($_POST['newpasword']))
    $newPassword = $_POST['newpassword'];
else
    $newPassword = null;

if (isset($_POST['password']))
    $currentPassword = $_POST['password'];
else
    error_die("Missing POST parameter 'password'.");

if (!User::testPassword($u->getID(), $currentPassword))
    error_die("Wrong password.");

try {
    $u->update($newEmail, $newUsername, $newPassword);
}
catch (UserExistsException $e)
{
    error_die($e->getMessage());
}

success_die($u);