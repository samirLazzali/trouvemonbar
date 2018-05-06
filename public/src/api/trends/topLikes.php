<?php

require_once("../../config.php");
require("Post.php");

$posts = Post::topLikes();

success_die($posts);