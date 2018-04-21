<?php
if (!defined('__ROOT__')) define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/config.php');
require_once(__ROOT__.'/classes/User.php');

/**
 * Created by PhpStorm.
 * User: drascma
 * Date: 21/04/18
 * Time: 11:42
 */
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>
            VITZ - Profil
        </title>
        <meta charset="utf-8" />
    </head>
    <body>
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
        <h1>Page de profil de <?=$user -> getUsername();?> </h1>

        <p>Email : <?$user -> getEmail(); ?></p>

        <?php
        if ($user -> getModerator() == 1){
            ?>
            <p>
                Modérateur
            </p>
            <?php
        }

        if($get == 1){
            ?>
            <a href = "List_suscribe.php?user=<?=$user; ?>">Liste des abonnements / abonnés</a>
            <?php
        }
        else{
            ?>
            <a href = "List_suscribe.php">Liste des abonnements / abonnés</a>
            <?php
        }
        ?>
        <br>
        <a href="main.php">Retour vers la page principale</a>
    </body>
</html>
