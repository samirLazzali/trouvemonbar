<?php
require_once("../config.php");

$trends = Trend::getTrends();

$tags = array_keys($trends);


?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="/assets/styles/trends.css" />
        <script src="/assets/js/trends.js"></script>
        <script src="/assets/js/general.js"></script>
        <script src="/assets/js/post.js"></script>
    </head>
    <body onload="getTopLikes()">
        <?php require "menu.php"; ?>
        <div class="column-wrapper">
            <h1>
                - tendances -
            </h1>
            <div id="trend-types">
                <a onClick="return getHashtags();" id="trend-selector-hashtags" class="trend-type-wrapper" href="#" title="Basculer vers les hashtags les plus publiés">
                    Hashtags
                </a>
                <a onClick="return getTopLikes();" id="trend-selector-likes" class="trend-type-wrapper selected" href="#" title="Basculer vers les publications les plus aimées">
                    Les plus aimés
                </a>
                <!--
                <a onClick="return updateTrends('fights');" id="trend-selector-fights" class="trend-type-wrapper" href="#">
                    Fights
                </a>
                -->
                <!--
                <a onClick="test();" id="trend-selector-controversial" class="trend-type-wrapper" href="#">
                    Controversé
                </a>
                -->
            </div>
            <div id="most-tweeted-hashtags">
                <div class="hashtags" id="hashtag-list">
                </div>
            </div>
            <div class="post-feed" id="post-feed">
            </div>
        </div>
    </body>
</html>
