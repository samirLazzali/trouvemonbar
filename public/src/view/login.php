<!DOCTYPE HTML>
<html>
    <head>
        <title>
            VITZ
        </title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="/assets/styles/login.css"/>
        <script src="/assets/js/forms.js"></script>
    </head>
    <body >
        <h1>
            VITZ
        </h1>

        <h2>
            Les ennemis de mes ennemis sont mes amis
        </h2>

        <p1>
            <div >
                <h3>Connexion</h3>
                <div id="infobox" class="error infobox">
                    ...
                </div>
                <form onSubmit="return login()">
                    <input id="field-username" type="text" name="username" placeholder="Nom d'utilisateur" />
                    <input id="field-password" type="password" name="password" placeholder="Mot de passe" />
                    <button type="submit" value="Se connecter">
                        Se connecter
                    </button>
                </form>
                <br>
                <br>
                Si vous n'avez pas encore de compte cliquez
                <a title="Créer un compte" href="new.php">
                    ici
                </a>
            </div>
            .
        </p1>

    </body>
</html>