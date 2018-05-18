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

$userReports = UserReport::getReports();
$postReports = PostReport::getReports(false);

if (count($userReports) + count($postReports) == 0)
    $noReports = true;
else
    $noReports = false;

?>
<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/assets/styles/visu_tweet.css" />
        <link rel="stylesheet" type="text/css" href="/assets/styles/moderation.css" />
        <link rel="stylesheet" type="text/css" href="/assets/styles/post.css" />
        <link rel="stylesheet" type="text/css" href="/assets/styles/general.css" />
        <script src="/assets/js/moderation.js"></script>
        <script src="/assets/js/general.js"></script>
        <title>Vitz - Modération</title>
        <meta charset="utf-8" />
    </head>
    <body>
        <?php require "menu.php"; ?>
        <div class="column-wrapper">
            <h1>
                - Modération -
            </h1>
            <?php if ($noReports): ?>
                <h2 class="all-done-message">
                    Terminé !
                </h2>
                <h2 class="smiley">
                    :)
                </h2>
                <h2 class="no-reports-message">
                    Aucun signalement à l'heure actuelle.
                </h2>
            <?php endif ?>
            <div id="user-reports">
                <?php
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
            <div id="post-reports" class="post-reports">
                <?php
                $seen = array();
                if ($postReports)
                    foreach($postReports as $report)
                    {
                        // On vérifie qu'on n'a pas déjà affiché les signalements pour ce post
                        if (in_array($report->getPostId(), $seen))
                            continue;
                        $seen[] = $report->getPostId();

                        // Si le post n'existe pas (par exemple, il a été supprimé depuis son signalement)
                        if ($report->getPost() == null)
                            continue;

                        // On trouve tous les signalements relatifs à ce post
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
                                            <?= $report->getReason() != "" ? $report->getReason() : "<span class='italic'>Aucune raison donnée.</span>" ?>
                                        </span>
                                    </div>
                                <?php endforeach ?>
                            </div>
                            <div class="moderation-actions-wrapper">
                                <a class="moderation-action" href="#" onClick="return resolvePostReport('<?= $report->getPostId(); ?>', true)" title="Supprimer cette publication.">
                                    <i class="fa fa-trash"></i> <span>Supprimer</span>
                                </a>
                                <a class="moderation-action" href="#" onClick="return resolvePostReport('<?= $report->getPostId(); ?>', false)" title="Ignorer les signalements associés à cette publication.">
                                    <i class="fas fa-check"></i> <span>Ignorer</span>
                                </a>
                            </div>
                        </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </body>
</html>
