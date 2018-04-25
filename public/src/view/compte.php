<?php
require_once("../config.php");
require_once("User.php");
?>

/**
 * Created by PhpStorm.
 * User: drascma
 * Date: 24/04/18
 * Time: 10:03
 */
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

<!DOCTYPE HTML>
<html>
<head>
    <title>
        VITZ - Compte
    </title>
    <meta charset="utf-8" />
    <script src="/assets/js/compte.js"></script>
</head>
<body>
<div class="form-wrapper">
    <div class="column-wrapper">
        <h1>
            - Publier -
        </h1>
        <div class="new-post-wrapper">
            <div onBlur="newPost_onBlur()"" onFocus="newPost_onFocus()" id="new-post-content" contenteditable="true">
            Nouvelle publication...
        </div>
        <button class="fas fa-paper-plane button-send" type="submit" onClick="sendNewPost()">
        </button>
    </div>
    <h1>
        - mon compte -
    </h1>
    <form onsubmit="return Change_info()">
        <label class="field-label" for="new-email">Adresse e-mail</label>
        <input class="field" type="text" placeholder=<?php $user->getEmail()?> id="new-email" />

        <label class="field-label" for="new-username">Nom d'utilisateur</label>
        <input class="field" type="text" placeholder=<?php $user->getUsername()?> id="new-username" />

        <label class="field-label" for="new-password">Mot de passe</label>
        <input class="field" type="password" placeholder="Mot de passe" id="new-password" />

        <button class="bouton" type="submit">
            Sauvegarder
        </button>
    </form>
</div>

</div>

</body>
</html>