<?php


session_start() ;

arme() ;


/* Cette fonction remplace l'arme équipée par l'utilisateur par celle qu'il n'avait pas sur lui.*/
function arme() {
    
    $nom_hote= "localhost" ; 
    $nom_base = getenv('DB_NAME'); 
    $nom_user = getenv('DB_USER');
    $mdp=getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");

    $req1 = $connection->prepare("UPDATE perso SET gear=? WHERE userName=? ;") ;
    $user = $_SESSION['userName'] ;
    $arme = $_SESSION['tab'][2] ;
    
    if ($arme == 'epee'){
        $arme = 'baton' ;
    }
    else {
        $arme = 'epee' ;
    }
    
    $reponse1 = $req1->execute([$arme, $user]) ;
    if ($reponse1) {
        header('Location: changemdp.php') ;
        exit() ;
    }
    else {
        header('Location: changemdp.php') ;
        exit() ;
    }
}