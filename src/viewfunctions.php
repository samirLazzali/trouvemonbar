<?php

function header($titre)
{
    print "<!DOCTYPE html>\n";
    print "<html>\n";
    print "  <head>\n";
    print "    <meta charset=\"utf-8\" />\n";
    print "    <title>$titre</title>\n";
    print "    <link rel=\"stylesheet\" href=\"tpStyle.css\"/>\n";
    print "  </head>\n";
  
    print "  <body>\n";
    print "    <header><h1> $titre </h1></header>\n";
}

function footer(){
	print "  </body>\n";
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
	$connexion = db_connect();
	$reponse = db_query($connexion, $requete);
	db_close($connexion);
	return $reponse;
}
function print_offer($offer){
	print "<div class=\"offer\">";
	print "<span class =\"offertitle\" onclick=\"document.getElementById($offer.getid()).style.display='block'\">$offer.gettitre()</span>";//on click fait aparaitre le reste.
	print "<p class=\"offerdesc\" id=\"$offer.getid()\" style=\"display:none\"> offer.getdescription()</p>"; //display none
	print "</div>";

}
function show_offers($offers){
	foreach($offers as $offer){
		printoffer($offer);
}
function indexco(){
/*	$semestre, $genre, $type = res de post */
    $offers = getoffers($semestre, $matiere, $type);
	show_offers($offers);
}

function indexnotco(){
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
