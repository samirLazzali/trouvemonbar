<?php

require_once("../config.php");

$u = getUserFromCookie();

if ($u == null)
{
    header("Location: /login");
    die();
}

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>
        Dernières publications
    </title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="assets/styles/feed.css" />
    <script src="/assets/js/general.js"><</script>
    <script src="/assets/js/post.js"><</script>
</head>
<body onload="refreshFeed()">
<?php require "menu.php"; ?>
<div class="column-wrapper">
    <h1>
        - Dernières publications -
    </h1>

    <?php
    $limit = 50;
    $people = $u->getSubscriptions();
    $posts = Post::findPosts($people, $limit);
        ?>
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
</div>
<script>
    var lastRefresh = <?= time(); ?>;
    function refreshFeed()
    {
        var feed = document.getElementById("post-feed");
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
                var result = JSON.parse(xhttp.responseText);
                if (result["status"] == 200)
                {
                    lastRefresh = result["timestamp"] - 1;
                    result = result["result"];
                    var html;
                    if (result.length > 0) {
                        Array.from(result).forEach(function(elt, idx, arr) {
                            var currentReport = document.getElementById("report-form-" + elt["id"]);
                            if (currentReport != undefined)
                                return;
                            if (elt["repostOf"] != null)
                                html = rawRepostToHtml(elt);
                            else
                                html = rawPostToHtml(elt);

                            feed.innerHTML = html + feed.innerHTML;
                        });
                    }
                    // On rappelle refreshFeed dans cinq secondes
                    setTimeout(function () {
                        refreshFeed();
                    }, 5000);
                }
            }
        };
        xhttp.open("POST", "/api/post/latest");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("after=" + lastRefresh + "&limit=25");
        return false;
    }
</script>
</body>
</html>