<?php

session_start();
include("vue.php");
include("config.php");

enTete("Une annonce");
page_accueil();
page_inscription();
page_connect();
page_profil();
page_deconnection();

//Si l'élève est connecté
if (isset($_SESSION["mail"])) {

    $id = $_GET["id"];
    $_SESSION["id"] = $id;
    $type = $_GET["type"];
    $_SESSION["type"]=$type;

    if ($type == 'trouve') {
        //Récupérer les données
        $query = $db->prepare('SELECT *
        FROM Objet
        NATURAL JOIN Trouve
        NATURAL JOIN Eleve
        WHERE id=? ');
        $query->execute(array($id));
        $data = $query->fetchAll();

        foreach ($data as $datas) {
            $mail = $datas["mail"];
            $nom = $datas["nom"];
            $prenom = $datas["prenom"];
            $pseudo = $datas["pseudo"];
            $promo = $datas["promo"];
            $telephone = $datas["telephone"];
            $titre = $datas["titre"];
            $_SESSION["titre"]=$titre;
            $description = $datas["description"];
            $date = $datas["date"];
            $image = $datas["image"];
            $categorie = $datas["categorie_t"];
            $endroit = $datas["endroit"];


            if ($image != null) {
                //Affichage
                echo '<h1><p> Annonce numéro ' . $id . ' : ' . $titre . '</p></h1>';
                echo '<img src=' . $image . ' alt="image représentant l\'annonce" />';
                echo '<p class="description"> Description : ' . $description . ' </p>';
                echo '<p class="info"> Cette annonce a été postée par ' . $nom . ' \' ' . $pseudo . ' \' ' . $prenom;
                echo nl2br("\r\n");
                echo 'que tu peux contacter par mail ' . $mail . ' ou par telephone ' . $telephone;
                echo nl2br("\r\n");
                echo ' vendue au prix de ' . $prix . ' Elle a été postée le ' . $date . ' et fait partie de la catégorie ' . $categorie . '</p>';
            } else {
                echo '<h1><p> Annonce numéro ' . $id . ' : ' . $titre . '</p></h1>';
                //echo '<img src=' . $image . ' alt="image représentant l\'annonce" />';
                echo '<p class="description"> Description : ' . $description . ' </p>';
                echo '<p class="info"> Cette annonce a été postée par ' . $nom . ' \' ' . $pseudo . ' \' ' . $prenom;
                echo nl2br("\r\n");
                echo 'que tu peux contacter par mail ' . $mail . ' ou par telephone ' . $telephone;
                echo nl2br("\r\n");
                echo 'trouvée à l\'endroit ' . $endroit . ' Elle a été postée le ' . $date . ' et fait partie de la catégorie ' . $categorie . '</p>';
            }

        }
        $query->closeCursor();
    }
    else {
        $query = $db->prepare('SELECT *
        FROM Objet
        NATURAL JOIN Vendre
        NATURAL JOIN Eleve
        WHERE id=? ');
        $query->execute(array($id));
        $data = $query->fetchAll();

        foreach ($data as $datas) {
            $mail = $datas["mail"];
            $nom = $datas["nom"];
            $prenom = $datas["prenom"];
            $pseudo = $datas["pseudo"];
            $promo = $datas["promo"];
            $telephone = $datas["telephone"];
            $titre = $datas["titre"];
            $_SESSION["titre"]=$titre;
            $description = $datas["description"];
            $date = $datas["date"];
            $image = $datas["image"];
            $categorie = $datas["categorie_v"];
            $prix = $datas["prix"];

            if ($image != null) {
                //Affichage
                echo '<h1><p> Annonce numéro ' . $id . ' : ' . $titre . '</p></h1>';
                echo '<img src=' . $image . ' alt="image représentant l\'annonce" />';
                echo '<p class="description"> Description : ' . $description . ' </p>';
                echo '<p class="info"> Cette annonce a été postée par ' . $nom . ' \' ' . $pseudo . ' \' ' . $prenom;
                echo nl2br("\r\n");
                echo 'que tu peux contacter par mail ' . $mail . ' ou par telephone ' . $telephone;
                echo nl2br("\r\n");
                echo ' vendue au prix de ' . $prix . ' Elle a été postée le ' . $date . ' et fait partie de la catégorie ' . $categorie . '</p>';
            } else {
                echo '<h1><p> Annonce numéro ' . $id . ' : ' . $titre . '</p></h1>';
                //echo '<img src=' . $image . ' alt="image représentant l\'annonce" />';
                echo '<p class="description"> Description : ' . $description . ' </p>';
                echo '<p class="info"> Cette annonce a été postée par ' . $nom . ' \' ' . $pseudo . ' \' ' . $prenom;
                echo nl2br("\r\n");
                echo 'que tu peux contacter par mail ' . $mail . ' ou par telephone ' . $telephone;
                echo nl2br("\r\n");
                echo ' vendue au prix de ' . $prix . ' Elle a été postée le ' . $date . ' et fait partie de la catégorie ' . $categorie . '</p>';
            }
        }
        $query->closeCursor();
    }
}
else {
    echo 'connecte toi pour pouvoir voir cette annonce !';
}

vue_terminer($mail);
vue_supprimer();

pied();
