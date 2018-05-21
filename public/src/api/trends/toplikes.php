<?php

require_once("../../config.php");

$getOriginals = false;
if (isset($_GET['getoriginals']))
    $getOriginals = $_GET['getoriginals'] == "true" ? true : false;

if (isset($_GET['timelimit']))
    $timelimit = $_GET['timelimit'];
else
    $timelimit = 0;

if (isset($_GET['limit']))
    $limit = $_GET['limit'];
else
    $limit = 10;

if ($limit > 250)
    $limit = 250;

$posts = Post::topLikes(Appreciation::LIKE,$limit,$timelimit);
success_die($posts);