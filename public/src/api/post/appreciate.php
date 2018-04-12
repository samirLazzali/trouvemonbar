<?php

require_once("../../config.php");
require_once("Appreciation.php");

if (isset($_GET['type']))
{
    $type = $_GET['type'];
    if (!($type == Appreciation::LIKE || $type == Appreciation::DISLIKE))
        error_die("Unknown appreciation: '$type'.");
}
else
    error_die("Missing GET argument 'type'.");

if (isset($_GET['post']))
    $postId = $_GET['post'];
else
    error_die("Missing GET argument 'post'.");

$user = verify_logged_in();

try {
    $a = Appreciation::create($postId, $user, $type);
}
catch (PostNotFoundException $e)
{
    error_die($e->getMessage());
}
success_die($a);