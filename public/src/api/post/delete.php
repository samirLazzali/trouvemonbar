<?php

/**
 * Supprime le tweet passé en paramètre GET 'id' (si l'utilisateur a les droits nécessaires)
 * Type requête : GET
 */

require_once("../../config.php");
require_once("User.php");

if (isset($_GET['id']))
    $id = $_GET['id'];
else
    error_die("Missing GET argument 'id'.");

$u = verify_logged_in();

try {
    $p = Post::fromID($id);
}
catch (PostNotFoundException $e)
{
    error_die($e->getMessage());
}

if ($p->getAuthorID() == $u->getID() || $u->getModerator())
{
    $p->delete();
    success_die($p);
}
else
    error_die("User doesn't have sufficient rights to delete post '$id'.");