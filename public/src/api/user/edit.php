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

$u = verify_logged_in();

if (isset($_POST['username']))
    $newUsername = $_POST['username'];
else
    $newUsername = null;

if (isset($_POST['email']))
    $newEmail = $_POST['email'];
else
    $newEmail = null;

try {
    $u->update($newEmail, $newUsername);
}
catch (UserExistsException $e)
{
    if ($e->getDuplicate() == UserExistsException::Duplicate_Username)
        error_die($e->getMessage(), ERROR_UsernameRegistered);
    else
        error_die($e->getMessage(), ERROR_EmailRegistered);
}

authenticate($u);
success_die($u);
