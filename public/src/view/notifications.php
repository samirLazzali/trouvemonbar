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
                            <a onClick="likePost('<?=$mention->getID()?>');" href="#" class="action-like-<?=$mention->getID()?> action-link">Like</a>
                        </span>
                        <span class="post-action">
                            <a onClick="dislikePost('<?=$mention->getID()?>');" href="#" class="action-dislike-<?=$mention->getID()?> action-link">Dislike</a>
                        </span>
                        <span class="post-action">
                            <a onClick="repost('<?=$mention->getID()?>');"  href="#" class="action-repost-<?=$mention->getID()?> action-link">Recycler</a>
                        </span>
                        <span class="post-action">
                            <a onClick="respondToPost('<?=$mention->getID()?>');"  href="#" class="action-respond-<?=$mention->getID()?> action-link">Riposter</a>
                        </span>
                        <span class="post-action">
                            <a onClick="toggleBlock('report-form-<?=$mention->getID()?>');"  href="#" class="action-report-<?=$mention->getID()?> action-link">Signaler</a>
                        </span>
                    </div>
                    <div style="display: none" class="report-form-wrapper" id="report-form-<?=$mention->getID()?>">
                        <form class="report-form">
                            <input type="text" id="report-reason-<?=$mention->getID()?>" class="report-field" placeholder="Raison du signalement">
                            <button type="submit" class="report-submit" onClick="reportPost('<?=$mention->getID()?>')">
                                Signaler
                            </button>
                        </form>
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
                            <a href="profile/<?=$appreciation->getPost()->getAuthor()->getUsername()?>" class="post-header-author">
                                <?=$appreciation->getPost()->getAuthor()->getUsername()?>
                            </a>
                            <span class="post-header-date">
                                <?=timestamp_to_string($appreciation->getPost()->getTimestamp())?>
                            </span>
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
                            <a href="profile/<?=$original->getAuthor()->getUsername()?>" class="post-header-author">
                                <?=$original->getAuthor()->getUsername()?>
                            </a>
                            <span class="post-header-date">
                                <?=timestamp_to_string($original->getTimestamp())?>
                            </span>
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

