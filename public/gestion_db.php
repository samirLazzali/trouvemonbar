<?php

/**
 * @brief permet de se connecter à db
 * @return un pdo
 */
function db_connect(){
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    try {
        $connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
    return $connexion;
}

/**
 * @brief ferme un pdo
 * @param $connexion un pdo
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