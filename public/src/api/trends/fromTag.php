<?php
require_once("../../config.php");
require_once("Post.php");
/**
 * Created by PhpStorm.
 * User: yeti
 * Date: 24/04/18
 * Time: 18:39
 */

if (isset($_GET['tag']))
    $tag = $_GET['tag'];

$posts = Post::fromHashtag($tag);

success_die($posts);