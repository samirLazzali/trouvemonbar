<?php
/**
 * Signale un post
 * Méthode : POST
 * Paramètres :
 * - post   : l'identifiant du post que l'on souhaite signaler
 * - reason : la raison du signalement
 * Renvoie :
 * - status = success en cas de réussite
 * - status = error si le post est inconnu, l'utilisateur n'est pas connecté
 */

require_once("../../config.php");
require_once("Appreciation.php");

if (isset($_POST['post']))
    $post = $_POST['post'];
else
    error_die("post", ERROR_FieldMissing);

if (isset($_POST['reason']))
    $reason = $_POST['post'];
else
    $reason = null;

$user = verify_logged_in();

try
{
    $p = Post::fromID($post);
}
catch (PostNotFoundException $e)
{
    error_die($e->getMessage(), ERROR_NotFound);
}

$p->addReport($user, $reason);