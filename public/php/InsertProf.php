<?php
/**
 * Created by PhpStorm.
 * User: shuo_xu
 * Date: 13/05/18
 * Time: 20:51
 */
include("Modele.php");
include("Vue.php");
$mdp = $_POST['mdp'];
$username = $_POST['uname'];
$date_naissance = $_POST['dnais'];

if($mdp != NULL) {
    if ($date_naissance != null) {
        if (verif_uname($username)) {
            entete();
            bandeau();
            affiche_info('Cette compte deja existe.<a href="Connexion.php">Veillez esseyer avec un autre.</a>.');
            pied();
        } else {
            entete();
            bandeau();
            if (create_client($username, $mdp, $date_naissance)) {
                affiche_info('Inscription reussit.<a href="Connexion.php">Veillez continuer.</a>.');
            } else {
                affiche_info('Inscription echout.<a href="Connexion.php">Veiller reessayer.</a>.');
            };
            pied();
        }
    }
    else {
        entete();
        bandeau();
        affiche_info('Veillez remplir votre date de naissance.<a href="Inscription.php">Veiller reessayer.</a>.');
        pied();
    }
}
else{
    entete();
    bandeau();
    affiche_info('Le mot de passe ne peut pas etre vide.<a href="Inscription.php">Veiller reessayer.</a>.');
    pied();
}
?>