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
        <script src="forms.js"></script>
    </head>
    <body>
        <h2>Création de compte</h2>
        <form onSubmit="return validate_input_signup();">
            <input id="field-username" type="text" name="username" placeholder="Nom d'utilisateur" />
            <input id="field-password" type="password" name="password" placeholder="Mot de passe" />
            <input id="field-email"    type="text" name="email" placeholder="Adresse email" />
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
