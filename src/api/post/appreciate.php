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
    error_die("Missing parameter 'type'.");

if (isset($_GET['post']))
    $postId = $_GET['post'];
else
    error_die("Missing parameter 'post'.");

// TODO: get real $author
$a = Appreciation::create($postId, $author, $type);
success_die($a);

?>