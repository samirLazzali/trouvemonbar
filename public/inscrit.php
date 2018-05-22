<?php

/* Ce fichier inclut le nouvel utilisateur dans la base de données */

session_start();

include("config.php");

inscription() ;


function inscription(){
    $personame = $_POST["personame"];
    $userName = $_POST["username"];
    $password = $_POST["password"];       /* Cette partie récupère les informations transmises par la methode post */
    $arme = $_POST["arme"];
    $result = $_POST["result"] ;


    if ($result == 0) {
        $result = rand(1,4) ;          /* Dans le cas où l'utilisateur ne remplirait pas le formulaire */
    }
    if ($result == 3) {
        $result = 'Guilde de l Ouest' ;
    }
    if ($result == 4) {
        $result = 'Guilde de l Est' ;          /*on associe le numéro renvoyé par le champ caché au nom d'une guilde */
    }
    if ($result == 1) {
        $result = 'Guilde du Sud' ;
    }
    if ($result == 2) {
        $result = 'Guilde du Nord' ;
    }


    $nom_hote= "localhost" ; 
    $nom_base = getenv('DB_NAME');                /* Connection à la base de données */
    $nom_user = getenv('DB_USER');
    $mdp=getenv('DB_PASSWORD');
    
    $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");
    $req1 =$connection->prepare("INSERT INTO \"users\" (username, character_name, password, status) VALUES (?, ?, ?, ?);");    /* Insertion dans la table users */
    $reponse1 = $req1->execute([$userName, $personame, $password, 'GM']);
    
    if ($reponse1) {
       $connection2 = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");
       $req2 =$connection2->prepare("INSERT INTO \"perso\" (username,character_name,gear,stamina,mana,strength,mind,sword_skill,staff_skill, guild, money,charac_lvl,charac_xp) VALUES (?,?,?,100,100,50,50,0,0,?,0,1,0);");
       $reponse2 = $req2->execute([$userName, $personame, $arme, $result]);                  /* Insertion dans la table perso */
    
	if ($reponse2) {
       	   $_SESSION['userName'] = $userName ;
       	   header('Location: accueilPerso.php');            /* Si l'inscription a réussi, relocalisation automatique vers la page de l'utilisateur avec la nouvelle variable de session */
       	   exit();
    	}
    	else {
       	   header('Location: inscription.php');
       	   echo 'inscription a échoué' ;
    	}
    }
    else {                                              /* Sinon relocalisation automatique vers la page d'inscription */
       	header('Location: index.php');
       	echo 'inscription a échoué' ;
    }
}







?>