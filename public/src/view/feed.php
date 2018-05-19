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
    <script src="/assets/js/general.js"></script>
    <script src="/assets/js/post.js"><</script>
    <script>
        var lastRefresh = <?= time(); ?>;
        var filter = "<?php
                $subscriptions = $u->getSubscriptions();
                if (count($subscriptions) > 0)
                    foreach($subscriptions as $sub)
                        echo $sub->getUsername() . ";";
                else
                    echo $u->getUsername();
            ?>";
        var _before = <?= end($posts)->getTimestamp(); ?>;
    </script>
</head>
<body onload="refreshFeed(lastRefresh, filter)">
<?php require "menu.php"; ?>
<div class="column-wrapper">
    <h1>
        - Dernières publications -
    </h1>
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
</body>
</html>