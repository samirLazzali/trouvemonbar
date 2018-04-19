<?php
/**
 * Created by PhpStorm.
 * User: yeti
 * Date: 19/04/18
 * Time: 11:03
 */
?>

<html>
    <head>
        <title>
            Création de compte
        </title>
        <meta charset="UTF-8" />
    </head>
    <body>
        <h2>Création de compte</h2>
        <form method="post" action="../api/user/new.php">
            <input type="text" name="username" placeholder="Nom d'utilisateur" />
            <input type="password" name="password" placeholder="Mot de passe" />
            <input type="text" name="email" placeholder="Adresse email" />
            <button type="submit" value="Créer son propre compte">
                Terminer
            </button>
        </form>
        <p>
            Si vous avez déjà un compte cliquez
            <a title="Créer un compte" href="login.php">
                ici
            </a>
            .
        </p>
    </body>
</html>
