<?php
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