<?php
if (!defined('__ROOT__')) define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . '/config.php');
require_once(__ROOT__ . '/classes/Trend.php');

$trends = Trend::getTrends();

$tags = array_keys($trends);


?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
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
                <a onClick="getHashtags();" id="trend-selector-hashtags" class="trend-type-wrapper selected" href="#">
                    Hashtags
                </a>
                <a onClick="getTopLikes();" onload="getTopLikes();" id="trend-selector-likes" class="trend-type-wrapper" href="#">
                    Les plus aimés
                </a>
                <a onClick="updateTrends('fights');" id="trend-selector-fights" class="trend-type-wrapper" href="#">
                    Fights
                </a>
                <a onClick="test();" id="trend-selector-controversial" class="trend-type-wrapper" href="#">
                    Controversé
                </a>
            </div>
            <div id="most-tweeted-hashtags">
                <div class="hashtags">
                    <?php
                    foreach ($tags as $tag)
                    {
                    ?>
                    <div class="hashtag-in-list">
                        <a onclick="getPostsFromHashtag('<?= $tag ?>')" href="#" class="hashtag-link">
                            <?= $tag ?>,
                        </a>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="post-feed" id="post-feed">
            </div>
        </div>
    </body>
</html>
