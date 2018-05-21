<?php

/**
 * @brief permet de se connecter à db
 * @return pdo
 */
function db_connect(){
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    try {
        $connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    }
    catch (PDOException $e) {
        print "Erreur : " . $e->getMessage() . "<br/>";
        die();
    }
    return $connexion;
}

/**
 * @brief ferme un pdo
 * @param $connexion  pdo
 */
function db_close($connexion){
    $connexion = null;
}

/**
 * @brief permet de récupérer le nom des recettes dans la table recettes
 * @param $connexion un pdo
 * @return un array avec toutes les recettes disponibles
*/
function recettes($connexion){
    $requete = "SELECT nom_rec FROM \"Recettes\"";
    $reponse = $connexion->query($requete);
    $tab = array();
    while ($tupleCourant = $reponse->fetch() ){
        $tab[]=$tupleCourant['nom_rec'];
    }
    $reponse = null;
    return $tab;
}

/**
 * @brief permet de récupérer le nom des ingredients necessaires pour une recette
 * @param $connexion un pdo et $rec une recette
 * @return un array avec tous les ingredients
 */
function ingredients_recettes($connexion,$rec){
    $requete = "SELECT nom_ingredient FROM Ingredients_Recettes WHERE nom_recette=$rec";
    $reponse = $connexion->query($requete);
    $tab = array();
    while ($tupleCourant = $reponse->fetch() ){
        $tab[]=$tupleCourant['nom_ingredient'];
    }
    $reponse = null;
    return $tab;
}


/**
 * @brief vérifit les données de connection en les comparant à celles dans la base de donnée
 * @param $pseudo et $pwd des chaines de caractères et $connexion un pdo
 * @return true si le mot de passe est correct, false sinon
 */
function verif($pseudo,$pwd,$connexion) {
    $salt = "@|-°+==00001ddQ";
    $mdp = md5($pwd.$salt);
    $requete = "SELECT pwd FROM \"user\" WHERE surname='$pseudo'";
    $reponse = $connexion->query($requete);
    $mot_de_passe = $reponse->fetch();
    if ($mot_de_passe['pwd']=="$mdp"){
        return true;
    }
    $reponse = null;
    return false;
}
