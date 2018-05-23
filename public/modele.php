<?php

include("db.php");


function config() {

    global $nom_hote, $nom_base, $nom_user, $mdp;
    $_SESSION['nomhote'] = $nom_hote;
    $_SESSION['nombase'] = $nom_base;
    $_SESSION['nomuser'] = $nom_user;
    $_SESSION['mdp'] = $mdp;

}

function test_input ($data) {

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;

}

function insert_produit($id_produit, $categorie, $types, $marque, $prix, $date_de_peremption, $reduction, $quantite, $id_centre_commercial)
{

    $connexion = db_connect();
    $rep = "INSERT INTO Produit(id_produit, categorie, types, marque, prix, date_de_peremption, reduction, quantite, id_centre_commercial)
    VALUES (" . $id_produit . ", " . $categorie . ", " . $type . ", " . $marque . ", " . $prix . ", " . $date_de_peremption . ", " . $reduction . ", " . $quantite . ", " . $id_centre_commercial . ");";

    $rep = db_query($db, $req);
    if (db_count($rep) == 0)
        return false;

    db_close($db);
    return true;

}

function insert_compte($id_utilisateur, $nom, $prenom, $mot_de_passe, $adresse)
{

    $connexion = db_connect();
    $rep = "INSERT INTO Utilisateur(id_utilisateur, nom, prenom, mot_de_passe, adresse, historique, commande)
    VALUES (" . $id_utilisateur . ", " . $nom . ", " . $prenom . ", " . $mot_de_passe . ", " . $adresse . ", 'NONE', 'NONE');";

    $rep = db_query($db, $req);
    if (db_count($rep) == 0)
        return false;

    db_close($db);
    return true;

}

?>

