<?php
/**
 * Ajoute une appréciation sur un post pour l'utilisateur connecté
 * Méthode : GET
 * Paramètres :
 * - type : le type d'appréciation (Like ou Dislike)
 * - post : l'identifiant du post auquel ajouter l'appréciation
 * Renvoie :
 * - status = success en cas de réussite
 * - status = error si le post est inconnu, l'utilisateur n'est pas connecté
 */

require_once("../../config.php");
require_once("Appreciation.php");

if (isset($_GET['type']))
{
    $type = $_GET['type'];
    if (!($type == Appreciation::LIKE || $type == Appreciation::DISLIKE))
        error_die("Unknown appreciation: '$type'.", ERROR_InvalidType);
}
else
    error_die("type", ERROR_FieldMissing);

if (isset($_GET['post']))
    $postId = $_GET['post'];
else
    error_die("post", ERROR_FieldMissing);

$user = verify_logged_in();

try {
    $a = Appreciation::create($postId, $user, $type);
}
catch (PostNotFoundException $e)
{
    error_die($e->getMessage(), ERROR_NotFound);
}
success_die($a);