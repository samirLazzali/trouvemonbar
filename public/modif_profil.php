<?php

session_start();
include("vue.php");
include("config.php");
enTete("Modification du profil");
page_accueil();

if ( !isset($_SESSION["mail"]))
{
    affiche_erreur('Tu n\'es pas connecté(e) !');
}
else {
    if (!isset($_POST["nom_modif"])) {
        vue_modif_profil();
    } else {

        // les erreures possibles
        $not_confirmed = NULL; //1
        $case_vide = NULL; //2

        //on récupere les donnees
        $i = 0;
        $mail = $_SESSION["mail"];
        $nom = $_POST["nom_modif"];
        $prenom = $_POST["prenom_modif"];
        $mdp = $_POST["mdp_modif"];
        $confirmation = $_POST["confirmation_modif"];
        $pseudo = $_POST["pseudo_modif"];
        $promo = intval($_POST["promo_modif"]);
        $tel = intval($_POST["telephone_modif"]);

        //1
        if ($mdp != $confirmation || empty($mdp) || empty($confirmation)) {
            $not_confirmed = " Votre mot de passe et votre confirmation diffèrent, ou sont vides";
            $i++;
        }

        //2
        if (empty($mail) || empty($nom) || empty($prenom) || empty($pseudo)) {
            $case_vide = "Les champs avec une * sont obligatoires.";
            $i++;
        }

        if ($i == 0) {
            $_SESSION["nom"] = $nom;
            $_SESSION["prenom"] = $prenom;
            $_SESSION["pseudo"] = $pseudo;
            $_SESSION["promo"] = $promo;
            $_SESSION["tel"] = $tel;
            $mail = "'" . $mail . "'";
            $nom = "'" . $nom . "'";
            $prenom = "'" . $prenom . "'";
            $mdp_autre = "'" . $mdp . "'";
            $pseudo = "'" . $pseudo . "'";
            $tel = "'" . $tel . "'";

            $request = " UPDATE eleve SET nom=$nom ,prenom=$prenom,mdp=$mdp_autre,pseudo=$pseudo,promo=$promo,telephone=$tel  
             WHERE mail=$mail";
            $db->exec($request);
            modif_faite();

        } else {
            echo '<h1 class="erreur"> Modification interrompue </h1>
            <p class="erreur"> Une ou plusieurs erreurs se sont produites pendant l\'inscription </p>
            <p class="erreur"> ' . $not_confirmed . '</p>
            <p class="erreur"> ' . $case_vide . '</p>';

            echo '<p class="erreur"> Pour <a href="./modif_profil.php"> recommencer les modifications! </a>  </p> ';
        }
    }
}

