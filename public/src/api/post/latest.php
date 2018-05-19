<?php
/**
 * Trouve les derniers posts en fonction du filtre donné
 * Méthode : POST
 * Paramètres :
 * - filter : noms d'utilisateur intéressants (username1;username2;...;usernameN)
 * - limit  : nombre maximum de tweets à récupérer (par défaut : 50)
 * Renvoie :
 * status = success, <Liste de <Post sérialisé>>
 */

require_once("../../config.php");


if (isset($_POST['limit']))
    $limit = $_POST['limit'];
elseif(isset($_GET['limit']))
    $limit = $_GET['limit'];
else
    $limit = 15;

if ($limit > 250)
    $limit = 250;

if (isset($_POST['after']))
    $after = $_POST['after'];
else
    $after = 0;

if (isset($_POST['before']))
    $before = $_POST['before'];
else
    $before = time();

if (isset($_POST['filter']) && trim($_POST['filter']) != '') {
    $filter = $_POST['filter'];
    $filter = trim($filter, ";");
    $people = explode(";", $filter);
}
else
{
    $filter = "";
    $people = array();
}

try
{
    $p = Post::findPosts($people, $limit, $after, $before);
    foreach($p as $post) {
        $post->getAuthor();
        $post->getRepostOf();
        if ($post->getRepostID() != null)
            $post->getRepostOf()->getAuthor();
    }

    success_die($p, true);
} 
catch (UserNotFoundException $e)
{
    error_die($e->getMessage(), ERROR_NotFound);
}