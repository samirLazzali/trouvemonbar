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
    <link rel="stylesheet" type="text/css" href="../assets/styles/feed2.css" />
</head>
<body>
<h1>
    Vitz
</h1>
<div class="column-wrapper">
    <h2>
        - Derniers Tweets -
    </h2>

    <?php
    $limit=4;
    $people=array();
    $posts = Post::findPosts($people, $limit);
        ?>
    <div class="post-feed">
        <?php
        foreach ($posts as $post){
        ?>
            <div class="post-in-feed">
                <div class="post-header">
                    <a href="profile/<?=$post->getAuthor()->getUsername();?>" class="post-header-author">
                        <p><?=$post->getAuthor()->getUsername();?></p>
                    </a>
                    <span class="post-header-date">
                        <p><?=$post->getTimestamp();?></p>
                    </span>
                </div>
                <div class="post-content">
                    <p><?=$post->getContent();?></p>
                </div>
                <div class="post-actions">
                    <span class="post-action">
                        <a onclick="likePost('<?=$post->getID()?>')" href="#" class="action-link">
                            Like
                        </a>
                    </span>
                    <span class="post-action">
                        <a onclick="dislikePost('<?=$post->getID()?>')" href="#" class="action-link">
                            Dislike
                        </a>
                    </span>
                    <span class="post-action">
                        <a onclick="repost('<?=$post->getID()?>')" href="#" class="action-link">
                            Reposter
                        </a>
                    </span>
                    <span class="post-action">
                        <a onclick="report('<?=$post->getID()?>')" href="#" class="action-link">
                            Signaler
                        </a>
                    </span>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
</body>
</html>