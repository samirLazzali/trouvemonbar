<?php

require_once("../../config.php");
require_once("User.php");

/**
 * Trouve les derniers posts en fonction du filtre donné
 * Type requête : POST
 * Paramètres :
 *     - filter : noms d'utilisateur intéressants (username1;username2;...;usernameN)
 *     - limit  : nombre maximum de tweets à récupérer (par défaut : 50)
 */

if (isset($_POST['limit']))
    $limit = $_POST['limit'];
else
    $limit = 50;

if (isset($_POST['filter'])) {
    $filter = $_POST['filter'];
    $people = explode(";", $filter);
}
else
{
    $filter = "";
    $people = array();
}

try
{
    $p = Post::findPosts($people, $limit);
    success_die($p);
}
catch (UserNotFoundException $e)
{
    error_die($e->getMessage());
}