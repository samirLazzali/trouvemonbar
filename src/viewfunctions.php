<?php

include("login/login.php");

function header_t($titre) {
    print "<!DOCTYPE html>\n";
    print "<html>\n";
    print "  <head>\n";
    print "    <meta charset=\"utf-8\" />\n";
    print "    <title>$titre</title>\n";
    print "    <link rel=\"stylesheet\" href=\"public/css/normalize.css\">\n";
    print "    <link rel=\"stylesheet\" href=\"public/css/header.css\">\n";
    print "    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>";
    print "    <link href=\"https://www.stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css\" rel=\"stylesheet\" integrity=\"sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN\" crossorigin=\"anonymous\">\n";
    print "    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css\">";
    print "    <link rel=\"stylesheet\" href=\"css/style.css\">";
    print "  </head>\n";
  
    print "  <body>\n";
    print "    <header role=\"header\">\n";
    print "    <nav class=\"menu\" role=\"navigation\">\n";
    print "    <div class=\"inner\">\n";
    print "    <div class=\"m-left\">\n";
    print "    <h1 class=\"logo\">$titre</h1>\n";
    print "    </div>\n";
    print "    <div class=\"m-right\">\n";
    print "    <a href=\"#\" class=\"m-link\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i> Accueil</a>\n";
    print "    <a href=\"#\" class=\"m-link\"><i class=\"fa fa-newspaper-o\" aria-hidden=\"true\"></i> Annonces</a>\n";
    print "    <a href=\"#\" class=\"m-link\"><i class=\"fa fa-question-circle-o\" aria-hidden=\"true\"></i> A propos</a>\n";
    print "    <a href=\"#\" class=\"m-link\"><i class=\"fa fa-paper-plane-o\" aria-hidden=\"true\"></i> Contact</a>\n";

    if (verif_authent()) {
	buttonLogout();
    } else {
	buttonLogin();
    }
    
    print "    </div>\n";
    print "    </div>\n";
    print "    </nav>\n";
    print "    </header>\n";
}

function footer(){
    print "  </body>\n";
    //print "<div id=\"footer\">";
    print "<footer>";
    print "<link rel=\"stylesheet\" href=\"public/css/normalize.css\">\n";
    print "<p>&copy; <b> 2018 ENSIIE </b> | Skutnik . Chekour . Trachino . Meas - All Rights Reserved  </p> </br>";
    print "<p> <b> Contact </b> : 06 59 42 47 94 | lesbonsbails@gmail.com | </p>";
    print "</footer>";
    print "</html>";

}

function getoffers($semestre, $module, $matiere){
    $requete = "SELECT * FROM annonce"; //default
    if($semestre){ //on ajoute des parametres en fonction de la recherche
	if($module){
	    if($matiere){
		$requete = $requete." WHERE semestre = $semestre AND  module = $module AND matiere = $matiere";
	    }
	    else
		$requete = $requete."  WHERE semestre = $semestre AND  module = $module";
	}
	else
	    $requete = $requete." WHERE semestre = $semestre";
    }
    else if($module){
	if($matiere){
	    $requete = $requete." WHERE module = $module AND matiere = $matiere";
	}
	else
	    $requete = $requete." WHERE module = $module";
    }
    else if($matiere){
	$requete = $requete." WHERE matiere = $matiere";
    }
    $connexion = dbConnect();
    $reponse = dbQuery($connexion, $requete);
	db_close($connexion);
	return $reponse;
}
function print_offer($offer){
	print "<div class=\"offer\">";
	print "<span class =\"offertitle\" onclick=\"document.getElementById($offer.getid()).style.display='block'\">$offer.gettitre()</span>";//on click fait aparaitre le reste.
	print "<p class=\"offerdesc\" id=\"$offer.getid()\" style=\"display:none\"> offer.getdescription()</p>"; //display none
	print "</div>";

}

function show_offers($offers) {
    foreach ($offers as $offer) {
        printoffer($offer);
    }
}

function indexco() {
/*	$semestre, $genre, $type = res de post 
*/	$offers = getoffers($semestre, $matiere, $type);
	show_offers($offers);
}

function indexnotco() {
	print "<h1> Bienvenue chez les bons bails! </h1>";
	print "<p> lorem ipsum .... </br>
				Connectez vous pour accéder aux offres 
			</p>";
	print "<p class='connexion'> Connectez-Vous! </p>"; // dans les styles mettre que class connexion ouvre onclick() auth()

}

function affiche($str) {
    echo $str;
}


function affiche_info($str) {
    echo '<p>'.$str.'</p>';
}

function affiche_erreur($str) {
    echo '<p class="erreur">'.$str.'</p>';
}

?>
