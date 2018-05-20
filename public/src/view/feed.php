<?php

require_once("../config.php");

$u = getUserFromCookie();

if ($u == null)
{
    header("Location: /login");
    die();
}

$limit = 50;
$people = $u->getSubscriptions();
if (count($people) == 0)
    $people = array($u);
$posts = Post::findPosts($people, $limit);
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Vitz - Dernières publications</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="assets/styles/feed.css" />
    <link rel="stylesheet" type="text/css" href="assets/styles/moderation.css" />
    <script src="/assets/js/general.js"></script>
    <script src="/assets/js/post.js"></script>
    <script>
        var lastRefresh = <?= time(); ?>;
        var filter = "<?php
                $subscriptions = $u->getSubscriptions();
                if (count($subscriptions) > 0) {
                    foreach ($subscriptions as $sub)
                        echo $sub->getUsername() . ";";
                }
                else
                    echo $u->getUsername();
            ?>";
        var _before = <?= count($posts) > 0 ? end($posts)->getTimestamp() : time(); ?>;
    </script>
</head>
<body onload="refreshFeed(lastRefresh, filter)">
<?php require "menu.php"; ?>
<img src="/assets/media/enlarge.jpg" style="float: left; margin-top: 100px;" />
<div class="column-wrapper">
    <h1>
        - Dernières publications -
    </h1>
    <?php if (count($posts) == 0): ?>
        <div>
            <h2 class="all-done-message">
                Rien ici
            </h2>
            <h2 class="smiley">
                :|
            </h2>
            <h2 class="no-reports-message">
                Aucune publication disponible dans votre fil.
            </h2>
        </div>
    <?php die(); endif; ?>
    <a id="link-posts-waiting" class="link-posts-waiting display-none" href="#" onClick="return showWaitingPosts();">
        <div class="post-in-feed" id="link-posts-waiting-wrapper">
            Nouvelles publications
        </div>
    </a>
    <div class="post-feed" id="post-feed">
        <?php
        foreach ($posts as $post){
            if ($post->getRepostID() == null)
                affichePost($post);
            else
                afficheRepost($post);
        }
        ?>
    </div>
    <a id="link-more-posts" class="link-more-posts" href="#" onClick="return getPostsBefore(_before, filter);">
        <div class="post-in-feed" id="link-more-posts-wrapper">
            Plus anciens
        </div>
    </a>
</div>
<div style="display: block; margin-left: auto; margin-right: auto;">
<img src="/assets/media/copine.jpg" style="max-width: 30%;" />
</div>
</body>
</html>