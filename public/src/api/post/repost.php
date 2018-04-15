<?php
/**
 * Publie un repost.
 * Méthode : GET
 * Paramètres :
 * - post : identifiant du post à reposter
 * Renvoie :
 * - status = success
 */

require_once("../../config.php");

if (isset($_GET['post']))
    $post = $_GET['post'];
else
    error_die("Missing GET field 'post'.");

$u = verify_logged_in();

$p = Post::repost($post, $u);
success_die($p);