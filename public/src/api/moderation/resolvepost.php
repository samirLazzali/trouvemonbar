<?php

require_once("../../config.php");

if (isset($_GET['post']))
    $postId = $_GET['post'];
else
    error_die("post", ERROR_FieldMissing);

if (isset($_GET['delete']))
    $deletePost = $_GET['delete'];
else
    error_die("delete", ERROR_FieldMissing);

try
{
    $p = Post::fromID($postId);
}
catch (PostNotFoundException $e)
{
    error_die("Post not found.", STATUS_NOT_FOUND);
}

$resolved = PostReport::resolveAll($p);

if ($deletePost)
    $p->delete();

success_die("$resolved reports resolved.");