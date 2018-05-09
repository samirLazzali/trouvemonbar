<!DOCTYPE HTML>
<html>
    <head>
        <title>
            Vitz
        </title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="/assets/styles/login.css"/>
        <script src="/assets/js/forms.js"></script>
    </head>
    <body >
        <h1 class="title">
            Vitz
        </h1>

        <h2 class="moto">
            Les ennemis de mes ennemis sont mes amis
        </h2>
        <h2 class="pageTitle">
            Connexion
        </h2>

        <div id="infobox" class="error infobox">
            ...
        </div>
        <div class="form-wrapper">
            <form id="form-login" onSubmit="return login()">
                <input class="field" id="field-username" type="text" name="username" placeholder="Nom d'utilisateur" />
                <input class="field" id="field-password" type="password" name="password" placeholder="Mot de passe" />
                <button class="button" type="submit" value="Se connecter">
                    Se connecter
                </button>
            </form>
        </div>

        <p class="center">
            <a title="Créer un compte" href="/signup">
                Vous n'avez pas de compte ?
            </a>
        </p>
            .

    </body>
</html>