<?php

require_once("../../config.php");
require_once("User.php");

define('DEFAULT_LIMIT', 50);

if (isset($_GET['count']))
    $limit  = $_GET['count'];
else
    $limit = DEFAULT_LIMIT;

if (isset($_GET['id']))
    $identifier = $_GET['id'];
elseif (isset($_GET['username']))
    $identifier = $_GET['username'];
else
    error_die("Missing parameter 'Username' or 'ID'");

try
{
    $user = User::findWithIDorUsername($identifier);
    $posts = $user->findPosts($limit);
    success_die($posts);
}
catch (UserNotFoundException $e)
{
    error_die("No such user.");
}