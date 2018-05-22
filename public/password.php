<?php

session_start() ;

modification() ;


/* Cette fonction reset le mot de passe de l'utilisateur avec ce que celui-ci l'ait entré dans un champ de la page profil.php.*/
function modification() {
    $ancien_password = $_POST["ancien_password"] ; /* Ancien mot de passe.*/
    $password = $_POST["password"] ; /* Nouveau mot de passe.*/
    
    $nom_hote= "localhost" ; 
    $nom_base = getenv('DB_NAME'); 
    $nom_user = getenv('DB_USER'); /* Connexion à la base de données */
    $mdp=getenv('DB_PASSWORD');
    
    $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp"); /* On recupère toute les lignes correspondant au nom d'utilisateur et au mot de passe indiqué.*/

    $req1 = $connection->prepare("SELECT * FROM \"users\" WHERE userName=? ;") ; /* Puis on effectue notre requête : récupérer l'ensemble de la table user correspondant à l'utilisateur.*/
    $user = $_SESSION['userName'] ;
    $reponse1 = $req1->execute([$user]) ;
    if ($reponse1) {
        $row = $req1->fetch() ;
        if ($row['password'] == $ancien_password) { /* Si l'ancien mot de passe a correctement été rentré,*/
            $connection1 = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");
            $req2 = $connection1->prepare("UPDATE \"users\" SET password=REPLACE(password, ?, ?) WHERE userName=? ;"); /* on met à jour le mot de passe.*/
            $reponse2 = $req2->execute([$ancien_password, $password, $user]) ;
            header('Location: accueilPerso.php') ;
            exit() ;
        }
    }
    else {
        header('Location : changemdp.php') ;
        exit() ;
    }
}







?>