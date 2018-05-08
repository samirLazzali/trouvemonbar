<?php

require_once("../config.php");

$u = getUserFromCookie();

if ($u == null)
{
    header("Location: /login");
    die();
}
// Si l'utilisateur n'est pas un modérateur, on le redirige
elseif (!$u->getModerator())
{
    header("Location: /");
    die();
}

?>
<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/src/assets/styles/visu_tweet.css" />
        <link rel="stylesheet" type="text/css" href="/src/assets/styles/moderation.css" />
        <link rel="stylesheet" type="text/css" href="/src/assets/styles/post.css" />
        <script src="/assets/js/moderation.js"></script>
        <meta charset="utf-8" />
    </head>
    <body>
        <div id="user-reports">
            <?php
            $userReports = UserReport::getReports();
            if ($userReports)
                foreach($userReports as $report)
                {
                    ?>
                    <div class="user-report">
                        <div class="user-report-list">

                        </div>
                    </div>
                    <?php
                }
            ?>
        </div>
        <div id="post-reports">
            <?php
            $postReports = PostReport::getReports();
            $seen = array();
            if ($postReports)
                foreach($postReports as $report)
                {
                    if (in_array($report->getPostId(), $seen))
                        continue;
                    $seen[] = $report->getPostId();

                    $samePostReports = $report->getSamePostReports();
                    ?>
                    <div class="post-report" id="post-report-<?= $report->getPostId() ?>">
                        <div class="post-report-post-wrapper">
                            <?php affichePost($report->getPost(), false); ?>
                        </div>
                        <div class="post-report-reports-wrapper">
                            <?php foreach ($samePostReports as $report): ?>
                                <div class="post-report-report">
                                    <span class="post-report-reporter">
                                        <a href="/profile/<?= $report->getReporter()->getUsername() ?>">
                                            <?= $report->getReporter()->getUsername() ?>
                                        </a>
                                    </span>
                                    <span class="post-report-reason">
                                        <?= $report->getReason() ?>
                                    </span>
                                </div>
                            <?php endforeach ?>
                        </div>
                        <div class="moderation-actions-wrapper">
                            <a class="moderation-action" href="#" onClick="resolvePostReport('<?= $report->getPostId(); ?>', true)">
                                <i class="fa fa-trash"></i> <span>Supprimer</span>
                            </a>
                            <a class="moderation-action" href="#" onClick="resolvePostReport('<?= $report->getPostId(); ?>', false)">
                                <i class="fas fa-check"></i> <span>Ignorer</span>
                            </a>
                        </div>
                    </div>
                <?php
            }
            ?>
        </div>
    </body>
</html>
