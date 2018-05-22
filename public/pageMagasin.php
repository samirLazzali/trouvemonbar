<?php

/* Ce fichier affiche l'onglet magasin, c'est à dire l'ensemble des éléments pouvant être acheté et ajouté dans l'inventaire du joueur.*/

session_start() ;

include("pageAccueil.php") ;
include("donneesPerso.php") ;


enTete("Magasin");

onglets() ;

fin_enTete();

magasin() ;


pied();


/* Cette fonction affiche l'or possédé par le joueur ainsi que l'ensemble des articles en vente dans le magasin.*/
function magasin() {
    $tab = $_SESSION['tab'] ;
    $money = $tab[13] ;
    print "<p> Il vous reste $money pièces d or " ;
    echo '<form action="magasin.php" method="post">  </p>' ;
    $tableau = items_magasin() ; /* Résultat de la recherche des articles du magasin dans la base de données.*/
    while ($row = $tableau->fetch()) { /* On parcours l'ensemble des articles pour les afficher.*/
        article($row) ;
	echo '</br>' ;
    }
    echo '<p> </br> <button type="submit">Acheter</button></p>';
    echo '</form>' ;
}


/* Cette fonction affiche un article avec son image et son bouton de sélection associé.*/
function article($tab) {
    $obj = str_replace("_", " ", $tab[0]) ;
    print "<p> <img src='$tab[0].jpg' alt='image de $obj'/>" ;
    print "</br> prix : $tab[1]";
    print "</br> <input type='radio' name='article' value=$tab[0]>" ;
    print "<label for= $tab[0]> $obj </label>" ;
    print "</p> </br>" ;
}



/* Cette fonction récupère l'ensemble des items du magasin depuis la base de données.*/
function items_magasin() {
    $nom_hote= "localhost" ; 
    $nom_base = getenv('DB_NAME'); 
    $nom_user = getenv('DB_USER'); /* Connexion à la base de données */
    $mdp=getenv('DB_PASSWORD');
    
    $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp"); /* On recupère toute les lignes correspondant au nom d'utilisateur et au mot de passe indiqué.*/
    
    $req = $connection->prepare("SELECT * FROM items ;") ; /* Puis on effectue notre requête.*/
    $reponse = $req->execute([]) ;
    if ($reponse){
       return($req) ;
    }
}



?>