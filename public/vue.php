<?php

function enTete($titre,$soustitre)
{
    print "<!DOCTYPE html>\n";
    print "<html>\n";
    print "  <head>\n";
    print "    <meta charset=\"utf-8\" />\n";
    print "    <title>$titre</title>\n";
    print "    <p>$soustitre</p>\n";
    print "    <link rel=\"stylesheet\" href=\"tpStyle.css\"/>\n";
    print "  </head>\n";
  
    print "  <body>\n";
    print "    <header><h1> $titre </h1></header>\n";
}

function pied(){
/* Compléter cette fonction afin qu'elle ferme les balises body et html */
	print "	</body>\n";
	print "</html>\n";
}

function foot(){
    print "<footer>\n";
    print " <ul>\n";
    print "  <h2>Auteur</h2>\n";
    print "  <li>Myr</li>\n";
    print "  <li>Téka</li>\n";
    print "  <li>Bode</li>\n";
    print "  <li>Gromminet</li>\n";
    print " </ul>\n";
    print "</footer>\n";
}

function affiche($str) {
    echo $str;
}

function lien($addresse,$str){
    echo '<a href="'.$addresse.'">'.$str.'</a>';
}

function affiche_info($str) {
    echo '<p>'.$str.'</p>';
}

function affiche_erreur($str) {
    echo '<p class="erreur">'.$str.'</p>';
}

function affiche_liste_article(){
    print " <ul>\n";
    print "  <h2>fruits/légumes</h2>\n";
    print "  <li>Pomme</li>\n";
    print "  <li>Banane</li>\n";
    print "  <li>mangue</li>\n";
    print "  <li>Orange</li>\n";
    print "  <h2>Viandes/Poissons</h2>\n";
    print "  <li>Boeuf</li>\n";
    print "  <li>Poulet</li>\n";
    print "  <li>Daurade</li>\n";
    print "  <li>Saumon</li>\n";
    print " </ul>\n";
}
?>