<?php
    require_once("../config.php");
    $user = getUserFromCookie();
    if ($user == null)
    {
        header("Location: /login");
        die();
    }
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Vitz - Notifications</title>
    <script src="/assets/js/post.js"></script>
    <script src="/assets/js/general.js"></script>
    <link rel="stylesheet" href="/assets/styles/notifications.css" />
</head>
<body>
<?php
    $notifications = $user->getNotifications();
    $appreciations = $notifications[0];
    $mentions = $notifications[1];
    $reposts = $notifications[2];
?>

    <div class="column-wrapper">
        <h1>- Notifications -</h1>
        <div class="post-feed">
            <?php
                foreach($mentions as $mention)
                    affichePost($mention, true,"a riposté !");
            ?>
            <?php
                foreach($appreciations as $appreciation):
            ?>
            <div class="post-in-feed">
                <div class="post-header">
                    <a href="/profile/<?=$appreciation->getAuthor()->getUsername()?>" class="post-header-author"><?=$appreciation->getAuthor()->getUsername()?></a>
                    <span class="notification-liked-you">a aimé votre publication.</span> <span class="post-header-date"><?=timestamp_to_string($appreciation->getTimestamp())?></span>
                </div>

                <div class="post-content">
                    <?php affichePost($appreciation->getPost(), false); ?>
                </div>
            </div>
            <?php
                endforeach
            ?>
            <?php
            foreach($reposts as $repost):
                    $original = $repost->getOriginalPost();
            ?>
            <div class="post-in-feed">
                <div class="post-header">
                    <a href="/profile/<?=$repost->getAuthor()->getUsername()?>" class="post-header-author">
                        <?=$repost->getAuthor()->getUsername()?>
                    </a>
                    <span class="notification-reposted-you">vous a recyclé.</span>
                    <span class="post-header-date"><?=timestamp_to_string($repost->getTimestamp())?></span>
                </div>

                <div class="post-content">
                    <?php affichePost($original, false); ?>
                </div>
            </div>
            <?php
                endforeach
            ?>
        </div>
    </div>
</body>
</html>

