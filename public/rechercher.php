<?php


session_start() ;



rechercher() ;


/* 
   Cette fonction affiche le profil d'un utilisateur recherché dans l'onglet des scores si celui-ci existe.
*/
function rechercher() {
   $user = $_POST["username"] ;
   $nom_hote= "localhost" ; 
   $nom_base = getenv('DB_NAME'); 
   $nom_user = getenv('DB_USER');  /* Connexion à la base de données */
   $mdp=getenv('DB_PASSWORD');
   
   $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp"); /* On recupère toute les lignes correspondant au nom d'utilisateur et au mot de passe indiqué. */
   
   $req = $connection->prepare("SELECT username FROM users WHERE username=? ;") ; /* Puis on effectue notre requête.*/
   $reponse = $req->execute([$user]);
   if ($reponse) {
       if ($req->rowCount() == 1) {
           $tuple = $req->fetch() ;
           $_SESSION["autreUser"] = $tuple[0] ;
           header('Location: autreSession.php') ; /*Si la recherche aboutit à un profil, l'utilisateur est rediridé vers celui-ci.*/
           exit() ;
       }
       else {
           header('Location: scores.php') ; /* Sinon l'utilisateur est rediridé vers l'onglet des scores.*/
           exit() ;
       }
    }
    else {
        header('Location: scores.php') ; /* Sinon l'utilisateur est rediridé vers l'onglet des scores.*/
        exit() ;
    }
}