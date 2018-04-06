<?php

require_once("../../config.php");
require_once(CLASSES_ROOT . "/User.php");

define(DEFAULT_LIMIT, 50);

if (isset($_GET['count']))
    $limit  = $_GET['count'];
else
    $limit = DEFAULT_LIMIT;

if (isset($_GET['id']))
    $id = $_GET['id'];
else
{
    // TODO
}

$user = User::findWithIDorUsername($id);

if ($user == null)
{
    // TODO
}
else
{
    // TODO
    $posts = $user->findPosts($limit);
    $returned = array("status" => "success", "result" => $posts);
}
?>