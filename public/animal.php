<?php

/* Ce fichier affiche l'onglet Votre animal, soit l'ensemble des informations disponibles sur le compagnon du joueur.*/

session_start();

include("pageAccueil.php") ;

enTete("Votre animal") ;

onglets() ;

fin_enTete() ;

animal() ;

pied() ;


/* Cette fonction affiche le compagnon du joueur.*/
function animal() {
    $tab = $_SESSION['tab'] ;
    if (($tab[9]==NULL) && ($tab[14] < 5)) { /* S'il n'a pas le niveau requis, un message indiquant que le joueur ne peut pas encore avoir de compagnon apparait.*/
        echo '<p>Vous n avez pas d animal pour le moment, vous pourrez en choisir un à partir du niveau 5</p>' ;
    }
    else if (($tab[9]==NULL) && ($tab[14] >= 5)) { /* S'il a le niveau requis mais qu'il ne possède pas de compagnon, un formulaire s'affiche pour que le joueur puisse en choisir un.*/
        echo '<p>Vous pouvez choisir un animal</p>' ;
        echo '<form action="pet.php" method="post">' ;
        $tableau = liste_animaux() ; /* On récupère l'ensemble des animaux depuis la base de données.*/
        $i = 0 ;
        while ($i < 5) { /* On parcourt l'ensemble des animaux pour les afficher avec un boutton de sélection.*/
            $row = $tableau->fetch() ;
            animaux($row) ;
            $i = $i+1 ;
            echo '</br>' ;
        }
        echo '<p><button type="submit" class="onglets">Choisir</button></p>';
        echo '</form>' ;
    }
    else { /* S'il possède déjà un compagnon, on affiche son image et ses statistiques.*/
        $pet =$tab[9] ;
        print "<p> $pet </p>" ;
        print "<br/>" ;
        print "<p><img id='pet' src=\"$pet.png\" alt=\"image de $pet\"/></p>" ;
        print "  <ul>" ;
        print "    <li> Niveau : $tab[11] </li> " ;
        print "    <li> XP : $tab[10]</li> " ;
        print "  </ul>" ;
    }
}


/* Cette fonction affiche un animal avec son image associée et un boutton de sélection.*/
function animaux($tab) {
    print "<p><img id='pet' src='$tab[0].png' alt='image de $tab[0]'/></p>" ;
    print "<p><input type='radio' id=$tab[0] name='pet' value=$tab[0]>" ;
    print "<label for=$tab[0]> $tab[0] </label></p>" ;
    print "</br>" ;
}


/* Cette fonction récupère l'ensemble des animaux depuis la base de données.*/
function liste_animaux() {
    $nom_hote= "localhost" ; 
    $nom_base = getenv('DB_NAME'); 
    $nom_user = getenv('DB_USER');
    $mdp=getenv('DB_PASSWORD');
    
    $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");
    
    $req = $connection->prepare("SELECT * FROM pet ;") ;
    $reponse = $req->execute([]) ;
    if ($reponse){
        return($req) ;
    }
}