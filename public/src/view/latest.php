<?php require_once("../config.php"); ?>

<html>
    <head>
        <title>Dernières publications</title>
        <meta charset="utf-8" />
    </head>
    <body>
    <?php
        if (getUserFromCookie() == null) { ?>
            <p>Vous n'etes pas connecté. <a href="login.php">Connexion</a></p>
        <?php die(); } ?>

    <?php
    $user = getUserFromCookie();
    $posts = $user->findPosts();
    foreach($posts as $post)
    {
        ?>
        <div class="aff_post">
            <p><strong>Date : <?=$post->getTimestamp();?></strong></p>
            <p><?=$post->getContent();?></p>
        </div>
        <?php
    }
    ?>
    </body>
</html>
