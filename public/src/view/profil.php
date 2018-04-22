<?php
if (!defined('__ROOT__')) define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/config.php');
require_once("User.php");

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
        // On regarde si l'utilisateur est connecté (on ne veut pas que les gens pas connectés accèdent au profil)
        if (getUserFromCookie() == null) { ?>
            <p>Vous n'etes pas connecté. <a href="login.php">Connexion</a></p>
            <?php die(); } ?>

        <?php
        // Si jamais on nous a donné un nom d'utilisateur dont on veut le profil, on va récupérer ce nom
        if (isset($_GET['user'])) {
            // On le récupère
            $user = $_GET['user'];

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
                // Si jamais on nous envoie une exception comme quoi l'utilisateur n'existe pas
                die("<p>L'utilisateur n'existe pas !</p>");
                // Bon en vrai le die(...) c'est un truc à ne pas faire, mieux vaudrait avoir une variable
                // $trouve = false ou true qui nous dit si l'utilisateur existe, et s'il n'existe pas, on affiche
                // un joli cadre "Utilisateur non trouvé etc."
            }
        }
        else {
            // Si jamais on ne nous donne pas de nom d'utilisateur, on affiche le profil de l'utilisateur connecté
            $user = getUserFromCookie();
        }
        ?>

        <h1>Page de profil de <?=$user->getUsername();?> </h1>

        <p>Email : <?=$user->getEmail(); ?></p>

        <?php
        if ($user->getModerator())
        {
            ?>
            <p>
                Modérateur
            </p>
            <?php
        }
        ?>

        <a href="List_suscribe.php?user=<?= $user->getUsername(); ?>">Liste des abonnements / abonnés</a>
        <a href="main.php">Retour vers la page principale</a>
    </body>
</html>
