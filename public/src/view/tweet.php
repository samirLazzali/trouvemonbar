<?php
require_once('../config.php');

if (isset($_GET['id']))
    $id = $_GET['id'];
else
    error_die("id", ERROR_FieldMissing);

$u = verify_logged_in();

try {
    $p = Post::fromID($id);
}
catch (PostNotFoundException $e)
{
    error_die($e->getMessage(), ERROR_NotFound);
}

$author = $p->getAuthor()->getUsername();
$reposts = $p->getReposts();
$likes = $p->getLikers();
$dislikes = $p->getDislikers();
$responses = $p->getResponsesTo();

function formatter_nombre($n, $mot)
{
    if ($n == 0)
        return "Aucun $mot";
    elseif ($n == 1)
        return "Un $mot";
    else
        return "$n $mot" . "s";
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Publication de <?=$author?></title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="/assets/styles/general.css" />
    <link rel="stylesheet" href="/assets/styles/post.css" />
    <script src="/assets/js/post.js"></script>
    <script src="/assets/js/general.js"></script>
</head>
<body>
    <?php require "menu.php"; ?>
    <div class="column-wrapper">
        <h1>
            - Discussion -
        </h1>
        <div class="post-feed">
            <?php
            affichePost($p);
            ?>
            <div class="splitter">
            </div>
            <div class="post-interactions">
                <div class="post-interaction interaction-type-selected" id="linkDetailsReposts">
                    <a href="#" onclick="return showReposts();">
                        <?= formatter_nombre(count($reposts), "recyclage") ?>
                    </a>
                </div>
                <div class="post-interaction" id="linkDetailsLikes">
                    <a href="#" onclick="return showLikes();">
                        <?= formatter_nombre(count($likes), "like") ?>
                    </a>
                </div>
                <div class="post-interaction">
                    <?= formatter_nombre(count($dislikes), "dislike") ?>
                </div>
            </div>
            <div class="post-interaction-details" id="details-reposts">
                <?php foreach ($reposts as $repost): ?>
                    <div class="post-interactions-details-item">
                        <a href="/profile/<?= $repost->getAuthor()->getUsername(); ?>">
                            <?= $repost->getAuthor()->getUsername(); ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="post-interaction-details display-none" id="details-likes">
                <?php foreach ($likes as $liker): ?>
                    <div class="post-interactions-details-item">
                        <a href="/profile/<?= $liker->getUsername(); ?>">
                            <?= $liker->getUsername(); ?>
                        </a>
                    </div>
                <?php endforeach; ?>            </div>
        </div>
        <div class="post-feed">
            <?php foreach ($responses as $item)
                    affichePost($item);
            ?>
        </div>
    </div>
</body>
</html>
