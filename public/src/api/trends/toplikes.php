<?php

require_once("../../config.php");

$posts = Post::topLikes();

success_die($posts);