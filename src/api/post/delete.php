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

try {
    $p = Post::fromID($id);
    $p->delete();
    success_die($p);
}
catch (PostNotFoundException $e)
{
    error_die($e->getMessage());
}