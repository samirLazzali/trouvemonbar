<?php
/**
 * Created by PhpStorm.
 * User: shuo_xu
 * Date: 14/05/18
 * Time: 12:24
 */
include("Modele.php");
include("Vue.php");
$uname = $_SESSION['uname'];
$dnais = $_POST['dnais'];

if($uname != NULL) {
    if ($dnais != null) {

        entete();
        bandeau();
        if (update_client($uname, $dnais)) {
            affiche_info('Modification réussie.<a href="Profil.php">Veuillez continuer.</a>.');
        } else {
            affiche_info('Modification échouée.<a href="Profil.php">Veuiller réessayer.</a>.');
        };
        pied();

    }
    else {
        entete();
        bandeau();
        affiche_info('Veuillez remplir votre date de naissance.<a href="Profil.php">Veuiller réessayer.</a>.');
        pied();
    }
}
else{
    entete();
    bandeau();
    affiche_info('Le mot de passe ne peut pas etre vide.<a href="Profil.php">Veuiller réessayer.</a>.');
    pied();
}