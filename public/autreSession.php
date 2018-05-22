<?php

/* Ce fichier affiche la session d'un autre utilisateur que celui qui est connecté pour que l'utilisateur connecté puisse le consulter */


session_start();

include("pageAccueil.php") ;
include("donneesPerso.php") ;

enTete($_SESSION['autreUser']);

onglets() ;

fin_enTete();

affichage() ;

animal() ;

bannir() ;

pied();


/* Cette fonction affiche l'image de la personne ainsi que ses caractéristiques, pour cela elle utilise les fonctions de donneesUtilisateur.php */
function affichage() {
    print "<section>" ;
    $tab = donnees_accueil($_SESSION["autreUser"]) ;
    $_SESSION['autre'] = $tab ;
    print "<h2>Cette personne appartient à la $tab[12]</h2>" ;
    if ($tab[2] == 'epee') {
        print "<p>  <img src='chevalier.png' alt='Photo de chevalier'  />  </p>" ;
    }
    if ($tab[2] == 'baton') {
       print " <p> <img src='mage.png' alt='Photo de mage' /> </p>" ;
    }
    print "</section>" ;
    print "<aside>" ;
    
    print "  <ul>" ;
    print "    <li> Endurance : $tab[3] </li> " ;
    print "    <li> Mana : $tab[4]</li> " ;
    print "    <li> Force : $tab[5] </li> " ;
    print "    <li> Mental : $tab[6] </li> " ;
    print "    <li> Talent à l épée : $tab[7] </li> " ;
    print "    <li> Talent magique : $tab[8] </li> " ;
    print "    <li> Niveau : $tab[14] </li> " ;
    print "    <li> XP : $tab[15] </li> " ;
    print "  </ul>" ;
    print "</aside>" ;
}


/* Cette fonction affiche l'image et les caractéristiques de l'animal de la personne ou precise que cette personne n'en a pas */
function animal() {
   $tab = $_SESSION['autre'] ;
   if ($tab['pet']==NULL) {
       echo '<p>Cette personne n a pas d animal pour le moment</p>' ;
   }
   else {
       $pet = $tab[9] ;
       print " <p> $pet " ;
       print "<br/>" ;
       print "<img src=\"$pet.png\" alt=\"image de $pet\"/>" ;
       print "  <ul>" ;
       print "    <li> Niveau : $tab[10] </li> " ;
       print "    <li> XP : $tab[11]</li> " ;
       print "  </ul>  </p>" ;
   }
}


/* Fonction d'affichage et de verification : elle verifie tout d'abord si la personne est admin ou non, si c'est la cas, elle regarde le status de la personne dont le profil est observé, et affiche les boutons Admin, Banned ou Unbanned en consequence */
function bannir() {
    $user = $_SESSION['userName'] ;
    $autreuser = $_SESSION['autreUser'] ;

/* partie de connection à la base de donnée pour prendre le status de l'utilisateur qui consulte la page */
    $nom_hote= "localhost" ; 
    $nom_base = getenv('DB_NAME'); 
    $nom_user = getenv('DB_USER');
    $mdp=getenv('DB_PASSWORD');
    
    $connection = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");
    $req = $connection->prepare("SELECT status FROM users WHERE username = ? ;") ;
    $reponse = $req->execute([$user]) ;
    
    if ($reponse) {
/* partie de connection à la base de données pour prendre le status de l'utilisateur dont la page est observée */
        $connection1 = new PDO("pgsql:host=postgres user=$nom_user dbname=$nom_base password=$mdp");
        $req1 = $connection1->prepare("SELECT status FROM users WHERE username = ? ;") ;
        $reponse1 = $req1->execute([$autreuser]) ;
        $tuple=$req->fetch() ;
	$tuple1=$req1->fetch() ;

/* On verifie deux cas de figure : */
	if (($tuple[0] == 'Admin') && ($tuple1[0] == 'GM')) { /* Je suis admin et cette personne est un joueur normal */
	   echo '<br/>' ;
	   echo '<a href="Banned.php"><input type="button" name="Banned" value="Banned" class="onglets"/></a>';
           echo '<a href="Admin.php"><input type="button" name="Admin" value="Admin" class="onglets"/></a>';
	   if ($_SESSION['autre'][12] != $_SESSION['tab'][12]) {
	       echo '<a href="changeGuilde.php"><input type="button" name="Changer de guilde" value="Changer de Guilde" class="onglets"/></a>';
	   }
	}
	if (($tuple[0] == 'Admin') && ($tuple1[0] == 'banned')) { /* Je suis admin et cette personne a été bannie */
	   echo '<br/>' ;
	   echo '<a href="Unbanned.php"><input type="button" name="Unbanned" value="Unbanned" class="onglets"/></a>';
	}
    }
}