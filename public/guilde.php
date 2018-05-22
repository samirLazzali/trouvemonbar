<?php

/* Ce fichier affiche l'onglet guilde, l'ensemble des factions qu'un joueur peut rejoindre lors de son inscription.*/

session_start();

include("pageAccueil.php") ;

enTete($_SESSION['tab'][12]);

onglets() ;

fin_enTete();

affiche_guilde() ;

pied();


/* Cette fonction affiche la guilde de l'utilisateur actuelle ainsi que le classement de l'ensemble des guildes.*/
function affiche_guilde() {
    $guilde =  $_SESSION['tab'][12]; /* Guilde de l'utilisateur.*/
    $infos = guilde() ; /* On récupère les information sur la guilde de l'utilisateur pour les affichers.*/

    print "<p><img src=$infos[1].png alt=''/></p>" ;
    print "<p><img src=$infos[1].jpg alt=''/></p>" ;
    print "<h2> Vous appartenez à la $guilde </h2>" ;
    print "<p> Votre guilde a actuellement $infos[2] points </p>" ;
    print "<p> Le chef de votre guilde est $infos[3] </p>" ;

    $req = classement_guilde() ; /* Récupère les informations de l'ensemble des guildes triées suivant leurs nombres de points.*/
    print "</br>" ;
    print "</br>" ;
    print "<h2><table>" ;
    print "<th><td>UserName</td><td>Level</td><td>XP</td></th>" ;
    $i = 0 ;
    while ($i < 3) { /* On parcourt l'ensemble des guildes pour les afficher dans le classement.*/
       $i = $i+1 ;
       $row = $req->fetch() ;
       print "<tr><td>$i</td><td>$row[0]</td><td>$row[2]</td><td>$row[1]</td></tr>" ;
    }
    print "</table></h2>" ;
}


/* Cette fonction récupère l'ensemble des informations sur la guilde de l'utilisateur (nom, nombre de points, chef de guilde).*/
function guilde() {
   $nom_hote= "localhost" ; 
   $nom_base = getenv('DB_NAME'); 
   $nom_user = getenv('DB_USER');
   $mdp=getenv('DB_PASSWORD');
   
   $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");
   
   $req = $connection->prepare("SELECT * FROM guilde WHERE guild_name= ? ;") ;
   $reponse = $req->execute([$_SESSION['tab'][12]]);
   if ($reponse) {
       return($req->fetch()) ;
   }
}


/* Cette fonction récupère l'ensemble des informations sur les guildes, triées par ordre décroissant suivant leur nombre de points.*/
function classement_guilde() {
   $nom_hote= "localhost" ; 
   $nom_base = getenv('DB_NAME'); 
   $nom_user = getenv('DB_USER');
   $mdp=getenv('DB_PASSWORD');
   
   $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");
   
   $req = $connection->prepare("SELECT username, charac_xp, charac_lvl FROM perso WHERE guild=? GROUP BY username ORDER BY charac_xp DESC LIMIT 3 ;") ;
   $reponse = $req->execute([$_SESSION['tab'][12]]);
   if ($reponse) {
       return($req) ;
   }
}