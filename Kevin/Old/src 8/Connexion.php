<?php
/**
 * Created by PhpStorm.
 * User: KevinXu
 * Date: 06/05/2018
 * Time: 13:26
 */

session_start();

function config() {
    global $nom_hote, $nom_user, $nom_base, $mdp;
    $_SESSION['nomhote'] = $nom_hote;
    $_SESSION['nombase'] = $nom_base;
    $_SESSION['nomuser'] = $nom_user;
    $_SESSION['mdp'] = $mdp;
}

function detruire_session() {
    session_destroy();
}

//https://openclassrooms.com/courses/concevez-votre-site-web-avec-php-et-mysql/session-cookies


