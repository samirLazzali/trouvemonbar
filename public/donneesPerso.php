<?php

/* Ce fichier contient des fonctions relatives aux données de l'utilisateur.*/


/* Cette fonction récupère l'ensemble des données du personnages.*/
function donnees_accueil($username) {
    $nom_hote= "localhost" ; 
    $nom_base = getenv('DB_NAME'); 
    $nom_user = getenv('DB_USER');
    $mdp=getenv('DB_PASSWORD');
    
    $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");
    
    $req = $connection->prepare("SELECT * FROM perso WHERE username = ? ;") ;
    $reponse = $req->execute([$username]) ;
    if ($reponse) {
        if($req->rowCount() == 1) {
            return($req->fetch()) ;
        }
    }
    else{
        return([0,0,0,0,0,0,0]) ;
    }
}


/* Cette fonction calcul et met à jour les stats du joueur (force, mental, niveau) suivant la quantité d'xp qu'il possède.*/
function calcul_niveau($xp, $lvl, $strength, $mind) {
    $i = 1 ;
    while($xp > 512) {
        $xp = $xp - $i * 512 ;
        $i = 1 + $i ;
    }
    if ($i != $lvl) { /* S'il y a eu monté de niveau, on met à jour la base de donnée.*/
        $nom_hote= "localhost" ; 
        $nom_base = getenv('DB_NAME'); 
        $nom_user = getenv('DB_USER');
        $mdp=getenv('DB_PASSWORD');
        $user = $_SESSION['userName'] ;
        $gear = $_SESSION['tab'][2] ;
        
        $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");
        
        $req = $connection->prepare("UPDATE perso SET strength=?, mind=?, charac_lvl=? WHERE username=?;") ;
        if(strcmp($gear, "baton")==0) /*Si le joueur avait un baton équipé, c'est son mental qui augmente avec la montée de niveau.*/
        	$reponse = $req->execute([$strength, $mind+($i-$lvl)*rand(7,13), $i, $user]) ;
        else /*Sinon le joueur avait une épée équipée, et c'est sa force qui augmente avec la montée de niveau.*/
        	$reponse = $req->execute([$strength+($i-$lvl)*rand(7,13), $mind, $i, $user]) ;
        if(!$reponse)
            exit("calcul_niveau(): connection failed");
    }
    return ($i) ;
}


/* Cette fonction récupère le contenu de l'inventaire du joueur.*/
function donnees_inventaire($username) {
    $nom_hote= "localhost" ; 
    $nom_base = getenv('DB_NAME'); 
    $nom_user = getenv('DB_USER');
    $mdp=getenv('DB_PASSWORD');
    
    $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");
    
    $req = $connection->prepare("SELECT * FROM inventory WHERE usename = ? ;") ;
    $reponse = $req->execute([$username]) ;
    if ($reponse) {
        return ($req);
    }
}