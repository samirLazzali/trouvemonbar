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
    <link rel="stylesheet" href="/assets/styles/moderation.css" />
</head>
<body>
<?php
    $notifications = $user->getNotifications();
    $appreciations = $notifications[0];
    $mentions = $notifications[1];
    $reposts = $notifications[2];
    $count = count($reposts) + count($mentions) + count($appreciations);
?>
    <?php require "menu.php"; ?>

    <div class="column-wrapper">
        <h1>- Notifications -</h1>
        <?php if ($count == 0): ?>
            <h2 class="all-done-message">
                Désolé.
            </h2>
            <h2 class="smiley">
                :(
            </h2>
            <h2 class="no-reports-message">
                Vous n'avez pas d'amis.
            </h2>
        <?php endif; ?>
        <div class="post-feed">
            <?php
                foreach($mentions as $mention)
                    affichePost($mention, true,"a riposté !", '<i class="fas fa-chess-knight post-response"></i>');
            ?>
            <?php
                foreach($appreciations as $appreciation):
                    if ($appreciation->getType() == Appreciation::LIKE):
            ?>
                <div class="post-in-feed">
                    <div class="post-header">
                        <span class="fas fa-heart post-liked"></span>
                        <a href="/profile/<?=$appreciation->getAuthor()->getUsername()?>" class="post-header-author"><?=$appreciation->getAuthor()->getUsername()?></a>
                        <span class="notification-liked-you">a aimé votre publication.</span> <span class="post-header-date" title="Heure de l'appréciation"><?=timestamp_to_string($appreciation->getTimestamp())?></span>
                    </div>

                    <div class="post-content">
                        <?php affichePost($appreciation->getPost(), false); ?>
                    </div>
                </div>
            <?php
                endif; endforeach;
            ?>
            <?php
            foreach($reposts as $repost):
                    $original = $repost->getOriginalPost();
            ?>
            <div class="post-in-feed">
                <div class="post-header">
                    <span class="fas fa-redo post-reposted"></span>
                    <a href="/profile/<?=$repost->getAuthor()->getUsername()?>" class="post-header-author">
                        <?=$repost->getAuthor()->getUsername()?>
                    </a>
                    <span class="notification-reposted-you">
                        vous a recyclé.
                    </span>
                    <span class="post-header-date" title="Date de la republication">
                        <?=timestamp_to_string($repost->getTimestamp())?>
                    </span>
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

