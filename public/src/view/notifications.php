<?php
    require_once("../config.php");
    $user = getUserFromCookie();
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Vitz - Notifications</title>
    <script src="/assets/js/post.js"></script>
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
                foreach($mentions as $mention):
            ?>
                <div class="post-in-feed">
                    <div class="post-header">
                        <a href="profile/<?=$mention->getAuthor()->getUsername()?>" class="post-header-author">
                            <?=$mention->getAuthor()->getUsername()?>
                        </a> a riposté !
                        <span class="post-header-date"><?=timestamp_to_string($mention->getTimestamp())?></span>
                    </div>

                    <div class="post-content">
                        <?=$mention->toHtml()?>
                    </div>

                    <div class="post-actions">
                        <span class="post-action">
                            <a onClick="likePost(<?=$mention->getID()?>);" href="#" class="action-link">Like</a>
                        </span>
                        <span class="post-action">
                            <a onClick="dislikePost(<?=$mention->getID()?>);" href="#" class="action-link">Dislike</a>
                        </span>
                        <span class="post-action">
                            <a onClick="respondToPost(<?=$mention->getID()?>);"  href="#" class="action-link">Reposter</a>
                        </span>
                        <span class="post-action">
                            <a onClick="reportPost(<?=$mention->getID()?>);"  href="#" class="action-link">Signaler</a>
                        </span>
                    </div>
                </div>
            <?php
                endforeach
            ?>
            <?php
                foreach($appreciations as $appreciation):
            ?>
            <div class="post-in-feed">
                <div class="post-header">
                    <a href="/profile/<?=$appreciation->getAuthor()->getUsername()?>" class="post-header-author"><?=$appreciation->getAuthor()->getUsername()?></a>
                    <span class="notification-reposted-you">a aimé votre publication.</span> <span class="post-header-date"><?=timestamp_to_string($appreciation->getTimestamp())?></span>
                </div>

                <div class="post-content">
                    <div class="post-in-feed">
                        <div class="post-header">
                            <a href="profile/Oxymore" class=
                            "post-header-author">Oxymore</a> <span class="post-header-date"><?=timestamp_to_string($appreciation->getPost()->getTimestamp())?></span>
                        </div>

                        <div class="post-content">
                            <?=$appreciation->getPost()->getContent()?>
                        </div>
                    </div>
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
                    <span class="notification-reposted-you">vous a copié</span>
                    <span class="post-header-date"><?=timestamp_to_string($repost->getTimestamp())?></span>
                </div>

                <div class="post-content">
                    <div class="post-in-feed">
                        <div class="post-header">
                            <a href="profile/<?=$original->getAuthor()->getUsername()?>" class=
                            "post-header-author">Oxymore</a> <span class=
                            "post-header-date"><?=$original->getTimestamp()?></span>
                        </div>

                        <div class="post-content">
                            <?=$original->getContent()?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                endforeach
            ?>


        </div>
    </div>
</body>
</html>

