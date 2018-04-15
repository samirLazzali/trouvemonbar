<?php
/**
 * Récupère les informations d'un post
 * Méthode : GET
 * Paramètres :
 * - id : l'identifiant du post
 * Renvoie :
 * - status = success, <Post sérialisé>
 * - status = erreur si le post associé à l'identifiant n'existe pas
 */

require_once("../../config.php");
require_once("Post.php");

if (isset($_GET['id']))
    $id = $_GET['id'];
else
    error_die("Missing GET argument 'id'.");

$u = verify_logged_in();

try {
    $p = Post::fromID($id);
    success_die($p);
}
catch (PostNotFoundException $e)
{
    error_die($e->getMessage());
}