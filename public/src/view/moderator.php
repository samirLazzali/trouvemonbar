<?php

$u = verify_logged_in();

// Si l'utilisateur n'est pas un modérateur, on le redirige
if (!$u->getModerator())
{
    header("Location: index.php");
    die();
}

?>
<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/src/assets/styles/visu_tweet.css" />
        <link rel="stylesheet" type="text/css" href="/src/assets/styles/moderation.css" />
        <meta charset="utf-8" />
    </head>
    <body>
        <div id="user-reports">
            <?php
            $userReports = UserReport::getReports();
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
            foreach($postReports as $report)
            {
                ?>
                <div class="post-report">
                    <p class="post-report-report">
                        <span class="post-report-reporter">
                            <?=$report->getReporter()->getName(); ?>
                        </span>
                        <span class="post-report-reason">
                            <?=$report->getReason(); ?>
                        </span>
                        <div class="post-report-post-wrapper">
                            <?=$report->getPost()->toString(); ?>
                        </div>
                    </p>
                </div>
                <?php
            }
            ?>
        </div>
    </body>
</html>
