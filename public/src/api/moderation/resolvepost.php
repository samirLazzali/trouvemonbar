<?php

require_once("../../config.php");

$u = verify_logged_in();
if (!$u->getModerator())
    error_die("Current user doesn't have sufficient rights.", ERROR_Permissions);

if (isset($_GET['post']))
    $postId = $_GET['post'];
else
    error_die("post", ERROR_FieldMissing);

if (isset($_GET['delete'])) {
    $deletePost = $_GET['delete'];
    if (strtolower($deletePost) == "true")
        $deletePost = true;
    elseif (strtolower($deletePost) == "false")
        $deletePost = false;
    else
        error_die("delete should be true or false.", STATUS_ERROR);
}
else
    error_die("delete", ERROR_FieldMissing);

try
{
    $p = Post::fromID($postId);
}
catch (PostNotFoundException $e)
{
    error_die("Post not found.", ERROR_Permissions);
}

$resolved = PostReport::resolveAll($p);

if ($deletePost)
    $p->delete();

success_die("$resolved reports resolved.");