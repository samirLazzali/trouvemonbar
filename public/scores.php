<?php

/* Ce fichier affiche l'onglet scores, c'est à dire le classement des différentes guildes et des dix meilleurs joueurs, ainsi qu'une barre de recherches our consulter la page d'un autre joueur à partir de son nom d'utilisateur */

session_start() ;
include("pageAccueil.php") ;


enTete("Scores") ;

onglets() ;

fin_enTete() ;


afficher_guildes() ;

afficher_perso() ;

recherche() ;

pied() ;


/* Cette fonction affiche les guildes par ordre décroissant suivant leur nombre de points.*/
function afficher_guildes() {
    print " <h2> Voici les scores des guildes : <h2> " ;
    print "<table>" ;
    print "<th><td>Nom de la guilde</td><td>Points</td></th>" ;
    
    $tab = points_guilde() ; /* Résultat de la recherche des guildes dans la base de données.*/
    
    $i = 0 ;
    while ($i < 4) { /* On parcourt le tableau récupéré pour en afficher le contenu.*/
       $i = $i+1 ;
       $row = $tab->fetch() ;
       print "<tr><td>$i</td><td>$row[0]</td><td>$row[2]</td></tr>" ;
       print "<br/>" ;
    }
    print "</table>" ;
    print "<br/>" ;
    print "<br/>" ;
    print "<br/>" ;
}
       

/* Cette fonction redirige l'utilisateur vers le profil qu'il recherche. (voir rechercher.php) */
function recherche() {
    print "<h2>Rechercher quelqu'un par son nom d'utilisateur</h2>" ;
    echo '<form action="rechercher.php" method="post">';
    echo ' <p> Nom Utilisateur :  <input type="text" size="20" maxlength="18" name="username" />';
    echo '<input type="submit" value="Rechercher" name="autentification"  class="onglets" /> </p>';
}


/* Cette fonction affiche successivement les 10 meilleurs joueurs.*/
function afficher_perso() {
    print " <h2> Voici les scores des dix meilleurs personnages : <h2> " ;
    print "<br/>" ;
    print "<table>" ;
    print "<th><td>UserName</td><td>Character</td><td>Level</td><td>XP</td></th>" ;
    $tab = points_joueurs() ; /* Résultat de la recherche des 10 meuilleurs joueurs dans la base de données.*/
    $i = 0 ;
    while ($i < 10) { /* On parcourt le tableau récupéré pour en afficher le contenu.*/
       $i = $i+1 ;
       $row = $tab->fetch() ;
       print "<tr><td>$i</td><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr>" ;
    }
    print "</table>" ;
}



/* Cette fonction récupère et tri les guildes suivant leur nombre de points.*/
function points_guilde() {
   $nom_hote= "localhost" ; 
   $nom_base = getenv('DB_NAME'); 
   $nom_user = getenv('DB_USER'); /* Connexion à la base de données */ 
   $mdp=getenv('DB_PASSWORD');
   
   $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");  /* On recupère toute les lignes correspondant au nom d'utilisateur et au mot de passe indiqué. */
   
   $req = $connection->prepare("SELECT * FROM guilde GROUP BY guild_name ORDER BY guild_points DESC;") ; /* Puis on effectue notre requête.*/
   $reponse = $req->execute([]);
   if ($reponse) {
       return($req) ;
   }
}


/* Cette fonction récupère et tri les 10 meilleurs joueurs suivant leur nombre de points.*/
function points_joueurs() {
   $nom_hote= "localhost" ; 
   $nom_base = getenv('DB_NAME'); 
   $nom_user = getenv('DB_USER');  /* Connexion à la base de données */
   $mdp=getenv('DB_PASSWORD');
   
   $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp"); /* On recupère toute les lignes correspondant au nom d'utilisateur et au mot de passe indiqué. */
   
   $req = $connection->prepare("SELECT username, character_name, charac_lvl, charac_xp FROM perso GROUP BY character_name, username ORDER BY charac_xp DESC LIMIT 10 ;") ; /* Puis on effectue notre requête.*/
   $reponse = $req->execute([]);
   if ($reponse) {
       return($req) ;
   }
}