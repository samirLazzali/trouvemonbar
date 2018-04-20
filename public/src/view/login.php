<?php
/**
 * Created by PhpStorm.
 * User: Drascma
 * Date: 19/04/18
 * Time: 13:06
 */
?>

<html>
    <head>
        <title>
            VITZ
        </title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="CSS/login.css"/>
    </head>
    <body >
        <h1>
            VITZ
        </h1>

        <h2>
            Les ennemis de mes ennemis sont mes amis
        </h2>

        <p1>
            <div>
                <h3>Connexion</h3>
                <form method="post" action="login-confirm.php">
                    <input type="text" name="username" placeholder="Nom d'utilisateur" /><br>
                    <input type="password" name="password" placeholder="Mot de passe" /><br>
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
