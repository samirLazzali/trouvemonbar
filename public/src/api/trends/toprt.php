<?php

require_once("../../config.php");

$getOriginals = false;
if (isset($_GET['getoriginals']))
    $getOriginals = $_GET['getoriginals'] == "true" ? true : false;

$posts = Post::topRt();



if ($getOriginals)
    foreach($posts as $post) {
        $post->getRepostOf();
        if ($post->getRepostID() != null)
            $post->getRepostOf()->getAuthor();
    }

success_die($posts);