<?php

/* Ce fichier permet la suppression d'un compte lorsque l'utilisateur clique sur le bouton associé dans l'onglet profil.*/

session_start() ;

delete() ;


/* Cette fonction supprime un utilisateur ainsi que son personnage de la base de données.*/
function delete() {
    
    $nom_hote= "localhost" ; 
    $nom_base = getenv('DB_NAME'); 
    $nom_user = getenv('DB_USER');
    $mdp=getenv('DB_PASSWORD');
    
    $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");

    $req1 = $connection->prepare("DELETE FROM perso WHERE userName=? ;") ; /* On supprime le personnage dans un premier temps.*/
    $user = $_SESSION['userName'] ;
    $reponse1 = $req1->execute([$user]) ;
    if ($reponse1) {
        $nom_hote= "localhost" ; 
        $nom_base = getenv('DB_NAME'); 
        $nom_user = getenv('DB_USER');
        $mdp=getenv('DB_PASSWORD');
        
        $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");

        $req2 = $connection->prepare("DELETE FROM users WHERE userName=? ;") ; /* Puis on supprime l'utilisateur.*/
        $reponse2 = $req2->execute([$user]) ;
        if ($reponse2) {
            header('Location: fermeture.php') ;
            exit() ;
        }
    }
    else {
        header('Location: changemdp.php') ;
        exit() ;
    }
}