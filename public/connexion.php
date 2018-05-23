<?php
session_start();
include("vue.php");
include("config.php");
enTete("Connexion");
page_accueil();

if ( isset($_SESSION["mail"]))
{
    affiche_erreur('Tu es déjà connecté !');
}
else {
    if (!isset($_POST["mail"])) {
        vue_connexion();
    } else {
        //recuperer la valeur saisie dans le champ "mail
        $mail = $_POST['mail'];
        //recuperer la valeur saisie dans le champ "mdp"
        $mdp = $_POST['mdp'];

        $message = 0;

        if (empty($mail) || empty($mdp)) //un champ n'est pas rempli
        {
            $message = 1;

        } else //on verifie le mdp
        {
            $query = $db->prepare('SELECT *
        FROM Eleve
        WHERE mail= ? ');
            $query->execute(array($mail));
            $data = $query->fetch();

            if ($data['mdp'] == $mdp) //acces OK
            {
                $_SESSION['mail'] = $data['mail'];
                $_SESSION['nom'] = $data['nom'];
                $_SESSION['prenom'] = $data['prenom'];
                $_SESSION['pseudo'] = $data['pseudo'];
                $_SESSION['promo'] = $data['promo'];
                $_SESSION['telephone'] = $data['telephone'];
                $_SESSION["admin"] = $data['admin'];

                $message = 2;
                $query->closeCursor();
            } else // Acces not OK
            {
                $message = 3;
            }
        }
            // Affichage des erreurs
        if ($message == 1) {
            affiche_erreur('une erreur s\'est produite pendant ton identification. 
        Vous devez remplir tous les champs');
            echo "<p align = \"center\" class='message'>Pour re-essayer <a href=\"./connexion.php\"> de te connecter!</a> </p>";
        }
        elseif ($message == 2) {
            echo "<p align = \"center\" class='succes'> Bienvenue " . $_SESSION['nom'] . " " . $_SESSION['prenom'] . " alias " . $_SESSION['pseudo'] . ",
        tu es maintenant connecté(e)! </p>";
        } else {
            affiche_erreur('Une erreur s\'est produite pendant ton identification. Le mot de passe ou le pseudo entré n\'est pas correct.');
            echo "<p> Pour re-essayer <a href=\"./connexion.php\"> de te connecter </a> ! </p>";
        }
    }
}
pied();



