<?php
/**
 * Renvoie les informations d'un utilisateur
 * Méthode : GET
 * Paramètres :
 * - identifier : l'ID ou le nom d'utilisateur de l'utilisateur dont on veut les informations
 * Renvoie :
 * - status = error si l'utilisateur n'est pas trouvé
 * - status = success, <User sérialisé> sinon
 */

require_once("../../config.php");
require_once("User.php");

if (isset($_GET['identifier']))
    $identifier = $_GET['identifier'];
else
    error_die("Missing GET argument 'identifier'.");

try
{
    $u = User::findWithIDorUsername($identifier);
}
catch (UserNotFoundException $e)
{
    error_die($e->getMessage());
}

success_die($u);