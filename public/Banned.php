<?php

session_start() ;

Banned() ;


/* Cette fonction donne le statut banni a un utilisateur */
function Banned() {
    $autreUser = $_SESSION['autreUser'] ;
    
    $nom_hote= "localhost" ; 
    $nom_base = getenv('DB_NAME'); 
    $nom_user = getenv('DB_USER');
    $mdp=getenv('DB_PASSWORD');
    
    $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");
    
    $req = $connection->prepare("UPDATE users SET status='banned' WHERE username = ? ;") ;
    $reponse = $req->execute([$autreUser]) ;
    if ($reponse) {
        header('Location: autreSession.php') ;
	exit() ;
    }
}