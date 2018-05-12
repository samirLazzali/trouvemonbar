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
    <?php require "menu.php"; ?>
    <div class="column-wrapper">
        <h1>
            - Publier -
        </h1>
        <div class="form-wrapper"
            <div class="new-post-wrapper">
                <div onBlur="newPost_onBlur()" onFocus="newPost_onFocus()" id="new-post-content" contenteditable="true">
                Nouvelle publication...
            </div>
        </div>
        <button class="fas fa-paper-plane button-send" type="submit" onClick="sendNewPost();">
        </button>
        <h1>
            - mon compte -
        </h1>
        <div id="info-missing-field" class="display-none error infobox">
            Erreur : le champ % doit etre rempli.
        </div>
        <form onsubmit="return updateAccount();">
            <label class="field-label" for="new-email">Adresse e-mail</label>
            <input class="field" onClick="accountFields_color()" type="text" placeholder="Nouvelle adresse e-mail" value="<?= $user->getEmail() ?>"  id="new-email" /><br/>

            <label class="field-label" for="new-username">Nom d'utilisateur</label>
            <input class="field" onclick="accountFields_color()" type="text" placeholder="Nouveau nom d'utilisateur" value="<?= $user->getUsername() ?>" id="new-username" /><br/>
            <button class="bouton" type="submit">
                Mettre à jour les informations
            </button>
        </form>
        <div style="height: 50px;"></div>
        <div id="info-password" class="display-none error infobox">
            Erreur : le mot de passe ne peut pas être vide.
        </div>
        <form onSubmit="return updatePassword();">
            <label class="field-label" for="current-password">Mot de passe actuel</label>
            <input onclick="passwordFields_color()" class="field" type="password" placeholder="Mot de passe actuel" id="current-password" /><br/>
            <label class="field-label" for="new-password">Nouveau mot de passe</label>
            <input onclick="passwordFields_color()" class="field" type="password" placeholder="Nouveau mot de passe" id="new-password" /><br/>
            <button class="bouton" type="submit">
                Modifier le mot de passe
            </button>
        </form>
    </div>
</body>
</html>