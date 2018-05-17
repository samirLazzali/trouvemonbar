<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 24/04/18
 * Time: 15:22
 *
 * This page is used by a user to review his own profile, or to check another's user public profile
 * @todo display a user profile (the user's id is passed via get method
 */
 require "../src/app/models/User.php";


function afficher_profil()
{
    Auth::get_user();
    try {
        $user = new User($_SESSION['user']);
        } catch (exception $e) {
    }
    // Si le paramètre id est manquant ou invalide
    if(empty( $user->getId()) or !is_numeric( $user->getId())){

        include "../src/app/views/erreur_parametre_profil.php";

    }
    else {


        // lire_infos_utilisateur() est défini dans ~/models/user.php
        $infos_utilisateur = $user->__construct($user-> getId());

        // Si le profil existe et que le compte est validé
        if (false !== $infos_utilisateur && $infos_utilisateur['hash_validation'] == '') {

            list($firstname,$lastname ,$nick, $mail) = $infos_utilisateur;
            include "../src/app/views/profil_utilisateur.php";

        } else {

            include "../src/app/views/erreur_parametre_profil.php";
        }
    }

}