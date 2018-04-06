<?php
require_once("../../config.php");
require_once("Post.php");

if (isset($_GET['id']))
    $id = $_GET['id'];
else
    error_die("Missing parameter 'id'.");

$p = Post::fromID($id);

if ($p == null)
    error_die("No such post.");
else
    success_die($p);