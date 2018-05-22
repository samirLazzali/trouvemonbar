<?php

/* Ce fichier contient les fonctions de presentation de l'ensemble des pages du site, pour faire la structure HTML. Elles sont importées pour ne pas être réécrites */


/*Affiche le titre du site de la page d'acceuil.*/
function enTeteAccueil($titre)
{
    print "<!DOCTYPE html>\n";
    print "<html>\n";
    print "  <head>\n";
    print "    <meta charset=\"utf-8\" />\n";
    print "    <title>Tales of Tiny Adventurers</title>\n";
    print "    <link rel=\"stylesheet\" href=\"styleSite.css\"/>\n";
    print "  </head>\n";
    print "  <body id='acc'>\n";
    print "    <header id='acc'><h1 id='acc'> $titre </h1>\n";
}

/* Donne un titre à la page.*/
function enTete($titre)
{
    print "<!DOCTYPE html>\n";
    print "<html>\n";
    print "  <head>\n";
    print "    <meta charset=\"utf-8\" />\n";
    print "    <title>$titre</title>\n";
    print "    <link rel=\"stylesheet\" href=\"styleSite.css\"/>\n";
    print "  </head>\n";
    print "  <body>\n";
    print "    <header><h1> $titre </h1>\n";
}



/* Affiche les deux champs textes correspondant au nom d'utilisateur et au mot de passe pour la connexion, ainsi qu'un bouton vers inscription. */
function autentifier() {
    echo '<form action="autentification.php" method="post">';
    echo '      Nom Utilisateur :  <input type="text" size="20" maxlength="18" name="username"/> <span id="aideUser"> </span> ';
    echo '<a href="inscription.php"><input type="button" name="Inscription" value="Inscription" class="onglets"/></a>';
    echo '<br/>' ;
    echo '      Mot de passe :     <input type="password" size="20" maxlength="18" name="password" />';
    echo '      <input type="submit" value="Connexion" name="autentification" class="onglets"/>';
    echo '</form>' ;

}


function fin_enTete(){
    print "</header>\n";
    }


/* Cette fonction affiche la vidéo utilisé dans la page d'acceuil.*/
function video(){
    print "<video autoplay loop id='bgvideo'>
        <source src='fond2.webm' type='video/webm' >
	<source src='fond2.wmp4' type='video/mp4' >
	<source src='fond2.ogv' type='video/ogv' >
       </video>   ";
}


/* Affiche les deux images du mage et du chevalier de la page d'acceuil.*/
function images() {
    print "<img class='mage' src='mage.png' alt='dessin de magicien'/>" ;
    print "<img class='chevalier' src='chevalier.png' alt='dessin de chevalier'/>" ;
}


function pied(){
    print "  </body>\n";
    print "</html>\n" ;

}

/* Affiche l'ensemble des onglets disponibles dans le header lors de la connexion. */
function onglets() {
    echo '<a href="accueilPerso.php"><input type="button" name="Personnage" value="Personnage" class="onglets" /></a>';
    echo '<a href="pageMagasin.php"><input type="button" name="Magasin" value="Magasin" class="onglets"/></a>';
    echo '<a href="quetes.php"><input type="button" name="Quêtes" value="Quêtes" class="onglets" /></a>';
    echo '<a href="animal.php"><input type="button" name="Votre Animal" value="Votre animal" class="onglets"/></a>';
    echo '<a href="scores.php"><input type="button" name="Scores" value="Scores" class="onglets"/></a>';
    echo '<a href="guilde.php"><input type="button" name="Votre Guilde" value="Votre Guilde" class="onglets"/></a>';
    echo '<a href="changemdp.php"><input type="button" name="Profil" value="Profil" class="onglets"/></a>';
    echo '<a href="fermeture.php"><input type="button" name="Deconnexion" value="Deconnexion" class="onglets"/></a>';
}



?>