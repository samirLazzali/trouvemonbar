<?php

/* Ce fichier affiche l'onglet personnage, c'est à dire la classe (chevalier ou mage), les caractéristiques et l'inventaire de l'utilisateur.*/

session_start();

include("pageAccueil.php") ;
include("donneesPerso.php") ;

enTete($_SESSION['userName']);

onglets() ;

fin_enTete();

affichage() ;

affiche_inventaire() ;

pied();


/* Cette fonction affiche soit un mage, soit un chevalier (suivant l'arme équipée par le joueur) ainsi que ses caractéristiques.*/
function affichage() {
    print "<div class='personnage'> ";
    $tab = donnees_accueil($_SESSION['userName']) ;
    $_SESSION['tab'] = $tab ;
    print "<section>" ;
    if ($tab[2] == 'epee') { /* On vérifie si l'arme équipée est une épée,*/
        print "  <img class='imggauche' src='chevalier.png' alt='Photo de chevalier' />" ;
    }
    if ($tab[2] == 'baton') { /* ou un bâton pour afficher l'image associée à la classe choisie.*/
        print "  <img class='imggauche' src='mage.png' alt='Photo de mage' />" ;
    }
    print "</section>" ;
    print "   </br> </br> </br> </br>  <div class='cadreperso'>  <h2> Vos caractéristiques : </h2>" ;
    print "<aside>" ;
    
    $lvl = calcul_niveau($tab[15], $tab[14], $tab[5], $tab[6]) ;
    
    print "  <ul>" ;
    print "    <li> Endurance : $tab[3] </li> " ;
    print "    <li> Mana : $tab[4]</li> " ;
    print "    <li> Force : $tab[5] </li> " ;
    print "    <li> Mental : $tab[6] </li> " ;
    print "    <li> Talent à l épée : $tab[7] </li> " ;
    print "    <li> Talent magique : $tab[8] </li> " ;
    print "    <li> Niveau : $lvl </li> " ;
    print "    <li> XP : $tab[15] </li> " ;
    print "  </ul>" ;
    print "</aside>" ;


}


/* Cette fonction affiche le contenu de l'inventaire du joueur.*/
function affiche_inventaire() {
    print "<h2> Votre inventaire : </h2>" ;
    
    $tab = donnees_inventaire($_SESSION['userName']) ;
    
    if ($tab->rowCount() >= 1) {
        print "  <ul>" ;
        $i = ($tab->rowCount()) ;
        while ($i > 0) {
            $row = $tab->fetch() ;
            $obj = str_replace("_", " ", $row[2]) ;
            print "    <li> $obj : $row[3] </li> " ;
            $inventaire[$row[2]] = $row[3] ;
            $i = $i-1 ;
        }
        $_SESSION['inventaire'] = $inventaire ;
        print "  </ul>" ;
    }
    else {
        print "<p>Votre inventaire est vide</p>" ;
    }
    print "</div> " ;	
    print "</div> ";
}



?>