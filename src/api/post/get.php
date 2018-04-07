<?php
require_once("../../config.php");
require_once("Post.php");

if (isset($_GET['id']))
    $id = $_GET['id'];
else
    error_die("Missing parameter 'id'.");

try {
    $p = Post::fromID($id);
    success_die($p);
}
catch (PostNotFoundException $e)
{
    error_die($e->getMessage());
}