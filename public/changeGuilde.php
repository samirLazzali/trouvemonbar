<?php

session_start() ;

Admin() ;


/* Cette fonction donne le statut admin a un utilisateur */
function Admin() {
    $autreUser = $_SESSION['autreUser'] ;
    $guilde = $_SESSION['tab'][12] ;
    
    $nom_hote= "localhost" ; 
    $nom_base = getenv('DB_NAME'); 
    $nom_user = getenv('DB_USER');
    $mdp=getenv('DB_PASSWORD');
    
    $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");
    
    $req = $connection->prepare("UPDATE perso SET guild=? WHERE username = ? ;") ;
    $reponse = $req->execute([$guilde, $autreUser]) ;
    if ($reponse) {
        header('Location: autreSession.php') ;
	exit() ;
    }
}