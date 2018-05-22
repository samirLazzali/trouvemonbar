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
 * @brief permet de récupérer le nom des ingredients dans la table ingredients
 * @param $connexion un pdo
 * @return un array avec tous les ingrédients disponibles
 */
function ingredient($connexion){
    $requete = "SELECT nom_ing FROM \"Ingredients\"";
    $reponse = $connexion->query($requete);
    $tab = array();
    while ($tupleCourant = $reponse->fetch() ){
        $tab[]=$tupleCourant['nom_ing'];
    }
    $reponse = null;
    return $tab;
}

/**
 * @brief permet d'afficher les recettes et leur description dans la table recettes
 * @param $connexion un pdo
 */
function descr_recettes($connexion){
    $requete = "SELECT nom_rec,description FROM \"Recettes\"";
    $reponse = $connexion->query($requete);
    while ($tupleCourant = $reponse->fetch() ){
        echo "<ul>";
        $rec = $tupleCourant['nom_rec'];
        echo "<li><strong><em>$rec</em></strong></li>";
        $descr = $tupleCourant['description'];
        echo "<p>$descr</p>";
        echo "</br>";
        echo "</ul>";
    }
    $reponse = null;
}

/**
 * @brief permet de récupérer les statistiques d'une soirée
 * @param $connexion un pdo et $soiree une soiree
 * @return un array avec toutes les statistiques
 */
function statistique($connexion,$soiree){
    $requete = "SELECT * FROM \"Statistiques\"WHERE soiree='$soiree'";
    $reponse = $connexion->query($requete);
    return $reponse->fetch();
}


/**
 * @brief permet de récupérer les noms des soirées
 * @param $connexion un pdo
 * @return un array avec tous les noms des soirees
 */
function soiree($connexion){
    $requete = "SELECT DISTINCT soiree FROM \"Statistiques\"";
    $reponse = $connexion->query($requete);
    $tab = array();
    while ($tupleCourant = $reponse->fetch() ){
        $tab[]=$tupleCourant['soiree'];
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
    $requete = "SELECT nom_ingredient FROM \"Ingredients_Recettes\" WHERE nom_recette='$rec'";
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

function inscript($surnom, $prenom,$nom,$mdp,$connexion){
    $salt = "@|-°+==00001ddQ";
    $pwd = md5($mdp.$salt);
    $instruction = $connexion->prepare("INSERT INTO \"user\"(surname, firstname, lastname, id, pwd) VALUES (:surnom,:prenom,:nom,1,:pwd)");
    $instruction->bindParam(':surnom',$surnom);
    $instruction->bindParam(':prenom',$prenom);
    $instruction->bindParam(':nom',$nom);
    $instruction->bindParam(':pwd',$pwd);
    $reponse = $instruction->execute();
    if ($reponse==false){
        return false;
    }
    return true;
}

function modif_mp($mdp,$connexion,$pseudo){
    $salt = "@|-°+==00001ddQ";
    $pwd = md5($mdp.$salt);
    $instruction = $connexion->prepare("UPDATE \"user\" SET pwd=:pwd WHERE surname=:pseudo");
    $instruction->bindParam(':pseudo',$pseudo);
    $instruction->bindParam(':pwd',$pwd);
    $reponse = $instruction->execute();
    if ($reponse==false){
        return false;
    }
    return true;
}

function ajouter($ingredients,$recette,$temps,$prix,$description,$connexion){
    $instruction = $connexion->prepare("INSERT INTO \"Recettes\"(nom_rec, temps, prix, description) VALUES (:recette,:temps,:prix, :descr)");
    $instruction->bindParam(':recette',$recette);
    $instruction->bindParam(':temps',$temps);
    $instruction->bindParam(':prix',$prix);
    $instruction->bindParam(':descr',$description);
    $reponse = $instruction->execute();
    if ($reponse==false){
        return false;
    }
    foreach ($ingredients as $ing){
        $instruction = $connexion->prepare("INSERT INTO \"Ingredients_Recettes\"(nom_recette, nom_ingredient) VALUES (:recette,:ing)");
        $instruction->bindParam(':recette',$recette);
        $instruction->bindParam(':ing',$ing);
        $reponse = $instruction->execute();
        if ($reponse==false){
            return false;
        }
    }
    return true;
}

function ajouter_ing($ing,$prix,$connexion){
    $instruction = $connexion->prepare("INSERT INTO \"Ingredients\"(nom_ing,prix) VALUES (:ing,:prix)");
    $instruction->bindParam(':prix',$prix);
    $instruction->bindParam(':ing',$ing);
    $reponse = $instruction->execute();
    if ($reponse==false){
        return false;
    }
    return true;
}

function modif_droit($pseudo,$droit,$connexion){
    $instruction = $connexion->prepare("UPDATE \"user\" SET id=:id WHERE surname=:pseudo");
    $instruction->bindParam(':pseudo',$pseudo);
    $instruction->bindParam(':id',$droit);
    $reponse = $instruction->execute();
    if ($reponse==false){
        return false;
    }
    return true;
}