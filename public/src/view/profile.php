<?php
require_once("../config.php");
require_once("User.php");

$currentUser = getUserFromCookie();

if ($currentUser == null)
{
    header("Location: /login");
    die();
}

$cu_subscriptions = array();
foreach($currentUser->getSubscriptions() as $sub)
    $cu_subscriptions[] = $sub->getUsername();


if (isset($_GET['user']))
{
    $user = $_GET['user'];
    $user = str_replace("@", "", $user);
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

<!DOCTYPE HTML>
<html>
    <head>
        <title>Vitz - Profil</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="/assets/styles/profile.css" />
        <script src="/assets/js/post.js" ></script>
        <script src="/assets/js/general.js"></script>
        <script src="/assets/js/user.js"></script>
        <script>
            var lastRefresh = <?= time(); ?>;
            var filter = "<?php $user; ?>";
            var _before = <?= end($posts)->getTimestamp(); ?>;
        </script>
    </head>
    <body onload="refreshFeed(lastRefresh, filter)">
        <?php require "menu.php"; ?>
        <?php
        // On regarde si l'utilisateur est connecté (on ne veut pas que les gens pas connectés accèdent au profil)
        if (getUserFromCookie() == null) {
            header("Location: /login");
            die();
        }

        // Si jamais on nous a donné un nom d'utilisateur dont on veut le profil, on va récupérer ce nom
        if (isset($_GET['user'])) {
            // On le récupère
            $user = $_GET['user'];
            if (substr($user, 0, 1) == "@")
                $user = substr($user, 1, strlen($user) - 1);

            // TRES IMPORTANT :
            // Le but, c'est qu'une fois qu'on a commencé à construire le "corps" de la page, on ne travaille
            // plus qu'avec des objets User. Ca nous simplifie grandement la tache.
            // Alors ce qu'on fait, c'est qu'on va se débrouiller pour trouver un utilisateur dans la BDD
            // dont le nom d'utilisateur est celui donné. Pour cela, on utilise User::fromUsername qui fait exactement
            // ce que je viens de dire.
            // Comme ça, qu'on ait récupéré l'utilisateur depuis les cookies ou depuis les paramètres GET, dans tous les
            // cas, on peut afficher ses infos de la meme manière (avec $user->getProperty())
            // Attention cependant, User::fromUsername lève une exception s'il n'y a pas d'utilisateur avec ce nom
            // C'est pour ça qu'on va devoir vérifier que tout se passe bien avec un try / catch
            try
            {
                // On essaie de trouver un utilisateur correspondant
                $user = User::fromUsername($user);
            }
            catch (UserNotFoundException $e)
            {
                ?>
                    <div class="column-wrapper">
                        <h1>
                            Cet utilisateur n'existe pas.
                        </h1>
                        <a href="/feed" class="centerlink">
                            Retour aux dernières publications.
                        </a>
                    </div>
                <?php
                die();
            }
        }
        else {
            // Si jamais on ne nous donne pas de nom d'utilisateur, on affiche le profil de l'utilisateur connecté
            $user = getUserFromCookie();
        }
        ?>

        <div class="column-wrapper">
            <h1 title="Pseudo de cet utilisateur">
                <?=$user->getUsername();?>
                <?php
                if ($user->getModerator()):
                    ?>
                    <i class="fas fa-check-circle moderator-tick"></i>
                <?php
                endif
                ?>
            </h1>

            <h2 class="section-title">
                <a class="section-title" href="/subscriptions/<?= $user->getUsername(); ?>">Liste des abonnements / abonnés</a>
            </h2>
            <h2 class="section-title">
                <a onClick="return toggleSubscription('<?=$user->getUsername()?>');" class="user-follow-link user-follow-link-<?= $user->getUsername(); ?> <?= in_array($user->  getUsername(), $cu_subscriptions) ? " user-follow-link-following" : "" ?>" href="#">
                    <?php
                    if($user->getID() != $currentUser->getID()):
                        if(!in_array($user->getUsername(), $cu_subscriptions)): ?>
                            S'abonner
                        <?php else: ?>
                            Abonné
                        <?php endif; endif; ?>
                </a>
            </h2>
            <h2 class="section-title">
                Dernières publications
            </h2>
            <a id="link-posts-waiting" class="link-posts-waiting display-none" href="#" onClick="return showWaitingPosts();">
                <div class="post-in-feed" id="link-posts-waiting-wrapper">
                    Nouvelles publications
                </div>
            </a>

            <div class="post-feed" id="post-feed">
                <?php
                $posts = $user->findPosts();
                foreach($posts as $post) {
                    if ($post->getRepostID() == null)
                        affichePost($post);
                    else
                        afficheRepost($post, " vous a recyclé");
                }
                ?>
            </div>
            <a id="link-more-posts" class="link-more-posts" href="#" onClick="return getPostsBefore(_before, filter);">
                <div class="post-in-feed" id=""link-more-posts-wrapper">
                Plus Anciens
        </div>
        </a>

        </div>
    </body>
</html>
