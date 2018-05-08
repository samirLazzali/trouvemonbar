<?php
require_once("../config.php");
require_once("User.php");

$user = getUserFromCookie();
if ($user == null)
{
    header("Location: /login");
    die();
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>
        Vitz - Compte
    </title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="/assets/styles/compte.css" />
    <script src="/assets/js/compte.js"></script>
    <script src="/assets/js/general.js"></script>
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
            <button class="fas fa-paper-plane button-send" type="submit" onClick="sendNewPost();">
            </button>
        </div>
        <h1>
            - mon compte -
        </h1>
        <div id="info-empty-pwd" class="error infobox">
            Erreur : le mot de passe ne peut pas être vide
        </div>
        <div id="info-missing-field" class="error infobox">
            Erreur, veuillez réessayer
        </div>
        <form onsubmit="return Change_info();">
            <label class="field-label" for="new-email">Adresse e-mail</label>
            <input class="field" type="text" value="<?= $user->getEmail() ?>"  id="new-email" /><br/>

            <label class="field-label" for="new-username">Nom d'utilisateur</label>
            <input class="field" type="text" value="<?= $user->getUsername() ?>" id="new-username" /><br/>

            <label class="field-label" for="new-password">Nouveau mot de passe</label>
            <input class="field" type="password" placeholder="motdepasse" id="new-password" /><br/>

            <button class="bouton" type="submit">
                Sauvegarder
            </button>
        </form>
    </div>
</body>
</html>