<?php

require_once("../../config.php");
require_once("User.php");
require_once("Post.php");

if (isset($_POST['content']))
    $content = $_POST['content'];
else
    error_die("Missing POST field 'content'.");

if (isset($_POST['responseTo']))
    $responseTo = $_POST['responseTo'];
else
    $responseTo = null;

$author = verify_logged_in();

if ($responseTo == null)
    $p = Post::post($author, $content);
else
    $p = Post::respondTo($responseTo, $author, $content);

success_die($p);