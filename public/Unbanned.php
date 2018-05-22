<?php

session_start() ;

Unbanned() ;


/* Cette fonction donne le statut banni a un utilisateur */
function Unbanned() {
    $autreUser = $_SESSION['autreUser'] ;
    
    $nom_hote= "localhost" ; 
    $nom_base = getenv('DB_NAME'); 
    $nom_user = getenv('DB_USER'); /* Connexion à la base de données */
    $mdp=getenv('DB_PASSWORD');
    
    $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp"); /* On recupère toute les lignes correspondant au nom d'utilisateur et au mot de passe indiqué. */
    
    $req = $connection->prepare("UPDATE users SET status='GM' WHERE username = ? ;") ; /* Puis on effectue notre requête.*/
    $reponse = $req->execute([$autreUser]) ;
    if ($reponse) {
        header('Location: autreSession.php') ;
	exit() ;
    }
}