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
        <title>
            Vitz - Profil
        </title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="/assets/styles/profile.css" />
        <script src="/assets/js/post.js" ></script>
        <script src="/assets/js/general.js"></script>
        <script src="/assets/js/user.js"></script>
    </head>
    <body>
        <?php require "menu.php"; ?>
        <?php
        // On regarde si l'utilisateur est connecté (on ne veut pas que les gens pas connectés accèdent au profil)
        if (getUserFromCookie() == null) { ?>
            <p>Vous n'etes pas connecté. <a href="login.php">Connexion</a></p>
            <?php die(); } ?>

        <?php
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
            <h1>
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
                <a onClick="toggleSubscription('<?=$user->getUsername()?>');" class="user-follow-link user-follow-link-<?= $user->getUsername(); ?> <?= in_array($user->  getUsername(), $cu_subscriptions) ? " user-follow-link-following" : "" ?>" href="#">
                    <?php if(!in_array($user->getUsername(), $cu_subscriptions)): ?>
                        S'abonner
                    <?php else: ?>
                        Abonné
                    <?php endif ?>
                </a>
            </h2>
            <h2 class="section-title">
                Dernières publications
            </h2>

            <div class="post-feed">
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

        </div>
    </body>
</html>
