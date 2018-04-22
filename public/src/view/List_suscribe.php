<?php
if (!defined('__ROOT__')) define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/config.php');
require_once(__ROOT__.'/classes/User.php');
/**
 * Created by PhpStorm.
 * User: Drascma
 * Date: 21/04/18
 * Time: 10:28
 */

?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>
            VITZ
        </title>
        <meta charset="utf-8" />
    </head>

    <body >
        <?php
        if (getUserFromCookie() == null) { ?>
            <p>Vous n'etes pas connecté. <a href="login.php">Connexion</a></p>
        <?php die(); } ?>

        <?php
        if (isset($_GET['user'])) {
            $get = 1;
            $user = $_GET['user'];
        }
        else {
            $get = 0;
            $user = getUserFromCookie();
        }
        ?>

        <h1>
            Liste des abonnements de <?=$user -> getUsername();?> :
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

        <?php
        if ($get  == 0) {
            ?>
            <a href = "profil.php">Retour vers le Profil</a>
            <?php
        }
        else {
            ?>
            <a href = "profil.php?user=<?=$user; ?>">Retour vers le Profil</a>
            <?php
        }
        ?>

        <a href = "profil.php">Retour vers le Profil</a>

    </body>

</html>