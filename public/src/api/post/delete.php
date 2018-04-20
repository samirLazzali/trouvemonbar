<?php
/**
 * Supprime un post
 * Méthode : GET
 * Paramètres :
 * - id : l'identifiant du post à supprimer
 * Renvoie :
 * - status = success si le post a pu etre supprimé
 * - status = error si le post n'appartient pas à l'utilisateur connecté et s'il n'est pas modérateur
 */

require_once("../../config.php");
require_once("User.php");

if (isset($_GET['id']))
    $id = $_GET['id'];
else
    error_die("id", ERROR_FieldMissing);

$u = verify_logged_in();

try {
    $p = Post::fromID($id);
}
catch (PostNotFoundException $e)
{
    error_die($e->getMessage(), ERROR_NotFound);
}

if ($p->getAuthorID() == $u->getID() || $u->getModerator())
{
    $p->delete();
    success_die($p);
}
else
    error_die("User doesn't have sufficient rights to delete post '$id'.", ERROR_Permissions);