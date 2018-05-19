<?php
require_once("../config.php");
require_once("User.php");

$currentUser = getUserFromCookie();

if ($currentUser == null)
{
    header("Location: /login");
    die();
}

$cu_followers = $currentUser->getFollowers();
$cu_subscriptions = array();
foreach($currentUser->getSubscriptions() as $sub)
    $cu_subscriptions[] = $sub->getUsername();

function formatter_nombre_abonnes($n)
{
    if ($n == 0)
        return "Aucun abonné";
    elseif ($n == 1)
        return "Un abonné";
    else
        return "$n abonnés";
}

function formatter_nombre_abonnements($n)
{
    if ($n == 0)
        return "Aucun abonnement";
    elseif($n == 1)
        return "Un abonnement";
    else
        return "$n abonnements";
}

?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Vitz - Abonnements</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="/assets/styles/subscriptions.css" />
        <script src="/assets/js/post.js" ></script>
        <script src="/assets/js/general.js"></script>
        <script src="/assets/js/user.js"></script>
    </head>

    <body>
        <?php require "menu.php"; ?>
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
            <h2 class="section-title">
                <a class="section-title" href="/profile/<?=$user->getUsername();?>">
                    Retour
                </a>
            </h2>
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
                        <a href="/profile/<?=$sub->getUsername()?>" title="Se rendre sur le profil">
                            <?=$sub->getUsername()?>
                        </a>
                    </div>
                    <div class="subscription-item-user-info">
                        <span class="subscription-item-count">
                            <?=formatter_nombre_abonnes(count($sub->getFollowers()))?>
                        </span> -
                        <span class="subscription-item-count">
                            <?=formatter_nombre_abonnements(count($sub->getSubscriptions()))?>
                        </span> -
                        <span class="subscription-item-follow-link">
                            <a onClick="return toggleSubscription('<?=$sub->getUsername()?>');" class="follow-link-<?=$sub->getUsername()?>" href="#">
                                <?php if(!in_array($sub->getUsername(), $cu_subscriptions)): ?>
                                    S'abonner
                                <?php else: ?>
                                    Abonné
                                <?php endif ?>
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
            <div class="subscriptions-wrapper">
            <?php
            $followers = $user->getFollowers();
            foreach($followers as $foll):
                ?>
                <div class="subscription-item">
                    <div class="subscription-item-user-name">
                        <a href="/profile/<?=$foll->getUsername()?>" title="Se rendre sur le profil">
                            <?=$foll->getUsername()?>
                        </a>
                    </div>
                    <div class="subscription-item-user-info">
                        <span class="subscription-item-count">
                            <?=formatter_nombre_abonnes(count($foll->getFollowers()))?>
                        </span> -
                        <span class="subscription-item-count">
                            <?=formatter_nombre_abonnements(count($foll->getSubscriptions()))?>
                        </span> -
                        <span class="subscription-item-follow-link">
                                <?php if(!in_array($foll->getUsername(), $cu_subscriptions)): ?>
                                    <a onClick="toggleSubscription('<?=$foll->getUsername()?>');" class="follow-link-<?=$foll->getUsername()?>" href="#">
                                        S'abonner
                                    </a>
                                <?php else: ?>
                                    <a onClick="toggleSubscription('<?=$foll->getUsername()?>');" class="follow-link-following follow-link-<?=$foll->getUsername()?>" href="#">
                                        Abonné
                                    </a>
                                <?php endif ?>
                        </span>
                    </div>
                </div>
            <?php
                endforeach
            ?>
            </div>
        </div>
    </body>

</html>