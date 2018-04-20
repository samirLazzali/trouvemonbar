<?php
/**
 * Renvoie les posts d'un utilisateur.
 * Méthode : GET
 * Paramètres :
 * - identifier : l'ID ou le nom d'utilisateur de l'utilisateur dont on veut les posts
 * - limit      : le nombre maximal de posts à renvoyer
 * Renvoie :
 * - status = error si l'utilisateur n'existe pas
 * - status = success, <Liste de <Post sérialisé>> sinon
 */

require_once("../../config.php");
require_once("User.php");

define('DEFAULT_LIMIT', 50);

if (isset($_GET['count']))
    $limit  = $_GET['count'];
else
    $limit = DEFAULT_LIMIT;

if (isset($_GET['identifier']))
    $identifier = $_GET['identifier'];
else
    error_die("identifier", ERROR_FieldMissing);

try
{
    $user = User::findWithIDorUsername($identifier);
    $posts = $user->findPosts($limit);
    success_die($posts);
}
catch (UserNotFoundException $e)
{
    error_die("No such user.", ERROR_NotFound);
}