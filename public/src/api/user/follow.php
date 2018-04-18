<?php
/**
 * Suit un utilisateur
 * Méthode : GET
 * Paramètres :
 * - identifier : l'ID ou le nom d'utilisateur que l'on veut suivre
 * Renvoie :
 * - status = error si l'utilisateur n'est pas trouvé
 * - status = success, <User sérialisé> sinon
 */

require_once("../../config.php");

if (isset($_GET['identifier']))
{
    $identifier = $_GET['identifier'];
}
else
    error_die("Missing GET argument 'identifier'.");

$user = verify_logged_in();

try
{
    $u = User::findWithIDorUsername($identifier);
}
catch (UserNotFoundException $e)
{
    error_die($e->getMessage());
}

$user->follow($u);