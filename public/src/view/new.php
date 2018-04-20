<?php
/**
 * Created by PhpStorm.
 * User: yeti
 * Date: 19/04/18
 * Time: 11:03
 */
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>
            Création de compte
        </title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="CSS/new.css"/>
    </head>
    <body>
        <div>
            <h2>Création de compte</h2>
            <form method="post" action="../api/user/new.php">
                <input type="text" name="username" placeholder="Nom d'utilisateur" /><br>
                <input type="password" name="password" placeholder="Mot de passe" /><br>
                <input type="text" name="email" placeholder="Adresse email" /><br>
                <button type="submit" value="Créer son propre compte">
                   Créer
                </button>
            </form>
            <p1>
                Si vous avez déjà un compte cliquez
                <a title="Créer un compte" href="login.php">
                    ici
                </a>
            </p1>
        </div>
    </body>
</html>
