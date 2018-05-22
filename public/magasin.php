<?php

session_start() ;


Acheter() ;


/* Modifie la table inventaire pour rajouter l'objet acheté. */
function Acheter() {

    $achat = $_POST['article'] ; /* On récupère le nom de l'objet acheté.*/
    $user = $_SESSION['userName'] ;
    $tab = $_SESSION['tab'] ;
    
    $nom_hote= "localhost" ; 
    $nom_base = getenv('DB_NAME'); 
    $nom_user = getenv('DB_USER'); /* Connexion à la base de données */
    $mdp=getenv('DB_PASSWORD');

    $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp"); /* On recupère toute les lignes correspondant au nom d'utilisateur et au mot de passe indiqué.*/
    
    $req = $connection->prepare("SELECT nb FROM inventory WHERE item_name = ? AND usename = ? ;") ; /* Puis on effectue notre requête : récupérer le nombre d'item acheté déjà possédé.*/
    $reponse = $req->execute([$achat, $user]) ;
    $row = $req->fetch() ;
    $price = price($achat) ; /* Prix de l'objet que l'on veut acheter.*/
    $nb = $row[0] ; /* Nombre d'objets déjà possédés.*/

    if ($req->rowCount() >= 1) { /* Si on possède déjà l'objet que l'on veut acheté*/
        if ($price <= $tab['money']) { /* et si le prix est inférieur à la quantité d'or possédée,*/
       	  	inventaire_ajout1($nb, $achat, $user) ; /* on achète l'objet */
            $_SESSION['tab'][13] = $tab['money'] - $price  ; /* et on met à jour l'argent possédé par le joueur.*/
            money($_SESSION['tab'][13], $user) ;
        	header('Location: accueilPerso.php') ;
        	exit() ;
        }
        else { /*Sinon on est redirigé vers le magasin.*/
            header('Location: pageMagasin.php') ;
            exit() ;
        }
    }
    else { /* Si on ne possède pas l'objet que l'on veut acheté*/
        if ($price <= $tab['money']) { /* et si le prix est inférieur à la quantité d'or possédée,*/
       	  	inventaire_ajout2($achat, $user) ; /* on achète l'objet.*/
            $tab['money'] = $tab['money'] - $price ;
	        $_SESSION['tab'][13] = $tab['money'] - $price  ;
            money($_SESSION['tab'][13], $user) ;
            header('Location: accueilPerso.php') ;
            exit() ;
        }
        else { /*Sinon on est redirigé vers le magasin.*/
            header('Location: pageMagasin.php') ;
            exit() ;   
        }
    }
}


/* Génère l'identifiant d'un objet à ajouter à l'inventaire de l'utilisateur (qu'il ne possédait pas encore).*/
function id() {
    $nom_hote= "localhost" ; 
    $nom_base = getenv('DB_NAME'); 
    $nom_user = getenv('DB_USER');
    $mdp=getenv('DB_PASSWORD');

    $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");
    
    $req = $connection->prepare("SELECT id FROM inventory GROUP BY id ORDER BY id DESC LIMIT 1 ;") ;
    $reponse = $req->execute([]) ;
    $row = $req->fetch() ;
    return($row[0]+1) ;
}


/* Cette fonction renvoie le prix d'un article donné en argument en utilisant la base de données.*/
function price($achat) {
    $nom_hote= "localhost" ; 
    $nom_base = getenv('DB_NAME'); 
    $nom_user = getenv('DB_USER');
    $mdp=getenv('DB_PASSWORD');

    $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");
    $req = $connection->prepare("SELECT price FROM items WHERE item_name=? ;") ;
    $reponse = $req->execute([$achat]) ;
    $row = $req->fetch() ;
    return($row[0]) ;
}


/* Cette fonction incrémente de 1 le nombre ($nb) d'objet ($achat) déjà possédé par un utilisateur ($username) dans la base de données.*/
function inventaire_ajout1($nb, $achat, $username) {
    $nom_hote= "localhost" ; 
    $nom_base = getenv('DB_NAME'); 
    $nom_user = getenv('DB_USER');
    $mdp=getenv('DB_PASSWORD');

    $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");
    $req = $connection->prepare("UPDATE inventory SET nb=? WHERE usename=? AND item_name=? ;") ;
    $reponse = $req->execute([$nb+1, $username, $achat]) ;
}


/* Cette fonction met à jour l'argent possédé par l'utilisateur dans la base de données.*/
function money($money, $user) {
    $nom_hote= "localhost" ; 
    $nom_base = getenv('DB_NAME'); 
    $nom_user = getenv('DB_USER');
    $mdp=getenv('DB_PASSWORD');

    $connection1 = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");
    
    $req1 = $connection1->prepare("UPDATE perso SET money=? WHERE username=? ;") ;
    $reponse1 = $req1->execute([$money, $user]) ;
}


/* Cette fonction ajoute un objet ($achat) à l'inventaire d'un utilisateur ($username) dans la base de données.*/
function inventaire_ajout2($achat, $user) {
    $nom_hote= "localhost" ; 
    $nom_base = getenv('DB_NAME'); 
    $nom_user = getenv('DB_USER');
    $mdp=getenv('DB_PASSWORD');

    $connection1 = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");
    
    $req1 = $connection1->prepare("INSERT INTO inventory (id, usename, item_name, nb) VALUES (?, ?, ?, 1) ;") ;
    $id = id() ;
    $reponse1 = $req1->execute([$id, $user, $achat]) ;
}


?>