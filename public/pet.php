<?php

session_start();

pet() ;


/* Cette fonction initialise le compagnon de l'utilisateur quand celui-ci a fait son choix dans l'onglet animal.php.*/
function pet() {
   $pet = $_POST['pet'] ;
   $user = $_SESSION['userName'] ;
   $nom_hote= "localhost" ; 
   $nom_base = getenv('DB_NAME'); 
   $nom_user = getenv('DB_USER'); /* Connexion à la base de données */
   $mdp=getenv('DB_PASSWORD');
   
   $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp"); /* On recupère toute les lignes correspondant au nom d'utilisateur et au mot de passe indiqué. */
   $req = $connection->prepare("UPDATE perso SET pet=?, pet_lvl=1, pet_xp=0 WHERE username =? ;") ; /* Puis on effectue notre requête.*/
   $reponse = $req->execute([$pet, $user]);
   if ($reponse) {
       header('Location: accueilPerso.php') ; /* On est redirigé vers la page de son personnage après l'initialisation.*/
       exit();
   }
}


?>