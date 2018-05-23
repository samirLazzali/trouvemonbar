<?php

session_start();
include("vue.php");
include("config.php");
enTete("Inscription");
page_accueil();

//Si l'élève est connecté
if ( isset($_SESSION["mail"]))
{
    affiche_erreur('Tu es déjà connecté(e) !');
}
else {
    if (!isset($_POST["mail"])) {
        vue_inscription();
    } else {

        // les erreures possibles
        $mail_not_free = NULL; //1
        $not_confirmed = NULL; //2
        $case_vide = NULL; //3
        $mail_not_ensiie=NULL ;//4

        //on récupere les donnees
        $i = 0;
        $mail = $_POST["mail"];
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $mdp = $_POST["mdp"];
        $confirmation = $_POST["confirmation"];
        $pseudo = $_POST["pseudo"];
        $promo = intval($_POST["promo"]);
        $tel = intval($_POST["telephone"]);

        //verification du mail
        $query = $db->prepare('SELECT COUNT(*) AS nbr FROM Eleve WHERE mail = ?');
        $query->execute(array($mail));
        $mail_free = ($query->fetchColumn() == 0) ? 1 : 0;

        //1
        if (!$mail_free) {
            $mail_not_free = "Votre mail a déjà été utilisé par un eleve";
            $i++;
        }

        //2
        if ($mdp != $confirmation || empty($mdp) || empty($confirmation)) {
            $not_confirmed = " Votre mot de passe et votre confirmation diffèrent, ou sont vides";
            $i++;
        }

        //3
        if (empty($mail) || empty($nom) || empty($prenom) || empty($pseudo)) {
            $case_vide = "Les champs avec une * sont obligatoires.";
            $i++;
        }

        //4
        if ( strstr($mail,'@')!='@ensiie.fr'){
            $mail_not_ensiie="Entre ton adresse mail de l'ensiie.";
            $i++;
        }

        if ($i == 0) {
            $_SESSION["mail"] = $mail;
            $_SESSION["nom"] = $nom;
            $_SESSION["prenom"] = $prenom;
            $_SESSION["pseudo"] = $pseudo;
            $_SESSION["promo"] = $promo;
            $_SESSION["tel"] = $tel;
            $_SESSION["admin"] = 'false';

            $mail = "'" . $mail . "'";
            $nom = "'" . $nom . "'";
            $prenom = "'" . $prenom . "'";
            $mdp_autre = "'" . $mdp . "'";
            $pseudo = "'" . $pseudo . "'";
            $tel = "'" . $tel . "'";

            //Insertion dans la base de données
            $request = "INSERT INTO eleve(mail,nom,prenom,mdp,pseudo,promo,telephone, admin) 
              VALUES($mail,$nom,$prenom,$mdp_autre,$pseudo,$promo,$tel,'false')";
            $db->exec($request);

            $query->closeCursor();
            fin_inscription($pseudo);

        } else {
            echo '<h1  class="erreur"> Inscription interrompue </h1>
            <p  class="erreur"> Une ou plusieurs erreurs se sont produites pendant l\'inscription </p>
            <p  class="erreur"> ' . $mail_not_free . ' </p>
            <p class="erreur"> ' . $not_confirmed . '</p>
            <p  class="erreur" > ' . $case_vide . '</p>
            <p  class="erreur" > ' . $case_vide . '</p>';

            echo '<p align = "center" class="erreur"> Recommence <a href="./inscription.php"> ton inscription </a> ! </p> ';
        }
    }
}