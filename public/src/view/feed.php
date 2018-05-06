<!DOCTYPE HTML>

<?php
require_once("../config.php");
require_once("../classes/Post.php");
?>

<html>
<head>
    <title>
        Derniers tweets
    </title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="assets/styles/feed.css" />
</head>
<body>
<div class="column-wrapper">
    <h1>
        - Derniers Tweets -
    </h1>

    <?php
    $limit=50;
    $people=array();
    $posts = Post::findPosts($people, $limit);
        ?>
    <div class="post-feed">
        <?php
        foreach ($posts as $post){
            if ($post->getRepostID() == null)
                affichePost($post);
            else
                afficheRepost($post);
        }
        ?>
    </div>
</div>
</body>
</html>