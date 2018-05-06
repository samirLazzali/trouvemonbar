<?php
require_once("../config.php");
require_once("User.php");
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>
            VITZ - Abonnements
        </title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="/assets/styles/subscriptions.css" />
        <script src="/assets/js/post.js" ></script>
        <script src="/assets/js/general.js"></script>
        <script src="/assets/js/user.js"></script>
    </head>

    <body >
        <?php
        if (getUserFromCookie() == null) { ?>
            <p>Vous n'etes pas connecté. <a href="login.php">Connexion</a></p>
        <?php die(); } ?>

        <?php
        if (isset($_GET['user']))
        {
            $user = $_GET['user'];
            try {
                $user = User::fromUsername($user);
            }
            catch (UserNotFoundException $e)
            {
                die("<p>Utilisateur non trouvé : $user.</p>");
            }
        }
        else
            $user = getUserFromCookie();
        ?>

        <div class="column-wrapper">
            <h1>
                - Abonnements -
            </h1>

            <div class="subscriptions-wrapper">
            <?php
            $subscriptions = $user->getSubscriptions();
            foreach($subscriptions as $sub)
            {
                ?>
                <div class="subscription-item">
                    <div class="subscription-item-user-name">
                        <?=$sub->getUsername()?>
                    </div>
                    <div class="subscription-item-user-info">
                        <span class="subscription-item-count">
                            <?=count($sub->getFollowers())?>
                        </span> abonnés -
                        <span class="subscription-item-count">
                            <?=count($sub->getSubscriptions())?>
                        </span> abonnements -
                        <span class="subscription-item-follow-link">
                            <a onClick="subscribeToUser('<?=$sub->getUsername()?>');" class="follow-link-<?=$sub->getUsername()?>" href="#">
                                S'abonner
                            </a>
                        </span>
                    </div>
                </div>
                <?php
            }
            ?>
            </div>

            <h1>
                - Abonnés -
            </h1>
            <?php
            $followers = $user->getFollowers();
            foreach($followers as $foll)
            {
                ?>
                <div class="subscription-item">
                    <div class="subscription-item-user-name">
                        <?=$foll->getUsername()?>
                    </div>
                    <div class="subscription-item-user-info">
                        <span class="subscription-item-count">
                            <?=count($foll->getFollowers())?>
                        </span> abonnés -
                        <span class="subscription-item-count">
                            <?=count($foll->getSubscriptions())?>
                        </span> abonnements -
                        <span class="subscription-item-follow-link">
                            <a onClick="subscribeToUser('<?=$foll->getUsername()?>');" class="follow-link-<?=$foll->getUsername()?>" href="#">
                                S'abonner
                            </a>
                        </span>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </body>

</html>