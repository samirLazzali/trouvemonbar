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

        <h1>
            Liste des abonnements de <?=$user->getUsername();?> :
        </h1>

        <?php

        $subscription = $user->getSubscriptions();
        foreach($subscription as $sub)
        {
            ?>
            <div>
                <p><?=$sub->getUsername();?></p>
            </div>
            <?php
        }
        ?>

        <h2>
            Liste des followers de <?=$user->getUsername();?> :
        </h2>
        <?php
        $followers = $user->getFollowers();
        foreach($followers as $foll)
        {
            ?>
            <div>
                <p><?=$foll->getUsername();?></p>
            </div>
            <?php
        }
        ?>

        <a href = "profile.php?user=<?=$user->getUsername()?>">Retour vers le Profil</a>

    </body>

</html>