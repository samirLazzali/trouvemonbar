<?php
    require "../config.php";
    if (getUserFromCookie() != null) {
        header("Location: feed.php");
        die();
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>
            Vitz # Création de compte
        </title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="/assets/styles/signup.css" />
        <script src="/assets/js/forms.js"></script>
    </head>
    <body>
        <h1 class="title">Vitz</h1>

        <h2 class="moto">Les ennemis de mes ennemis sont mes amis.</h2>

        <h2 class="pageTitle">Création de compte</h2>


        <div id="info-email-registered" class="error infobox">
            Une erreur est survenue : cet e-mail est déjà enregistré.
        </div>
        <div id="info-username-registered" class="error infobox">
            Une erreur est survenue : ce nom d'utilisateur est déjà utilisé.
        </div>
        <div id="info-password-weak" class="error infobox">
            Une erreur est survenue : votre mot de passe n'est pas assez complexe.
        </div>
        <div id="info-missing-field" class="error infobox">
            ...
        </div>

        <div class="form-wrapper">
            <form onSubmit="return validate_input_signup();">
                <input class="field topInput" id="field-username" type="text" name="username" placeholder="Nom d'utilisateur" />
                <input class="field" id="field-password" type="password" name="password" placeholder="Mot de passe" />
                <input class="field" id="field-email" type="email" name="email" placeholder="Adresse email" />
                <button class="button" type="submit" value="Valider la création de compte.">
                    Créer mon compte
                </button>
            </form>
        </div>

        <p class="center">
            <a title="Se connecter" href="login">
                Vous avez déjà un compte ?
            </a>
        </p>
    </body>
</html>
