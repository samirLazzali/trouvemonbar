<?php
/**
 * Created by PhpStorm.
 * User: kibtissam
 * Date: 20/05/2018
 * Time: 05:24
 */
require "../../src/app/helpers.php";

$mail = htmlspecialchars($_POST['email']);



    if (isset($_POST['email']))
    {



        $email = utf8_decode($_POST['email']);
        $token = sha1(uniqid(rand()));

        $query = db()-> prepare('alter table users add token char[100]');
        $success2 = $query->execute();

        $query= db()->prepare('UPDATE users  SET token=? WHERE mail=?');
        $success1=$query->execute([$token,$mail]);


        $query = db()->prepare('SELECT mail FROM users WHERE mail = ?');
        $success = $query->execute([$mail]);



        if ($success)								//Vérifie si le mail existe.
        {
            $to = $email;
            $sujet = 'Oublie du mot de passe';
            $body = 'Bonjour, vous avez oublié votre mot de passe, voici votre code de réinitialisation' . $token . '';
            if(mail($mail, $sujet, $body, $additional_parameters = null));
                echo"true";

        }
        else
        {
            echo "<p id='mauvais'>Adresse mail non inscrite.</p></center><br>";
        }
    }


?>
