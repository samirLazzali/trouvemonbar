<?php
include ("login.php");

function header_t($titre) {
    print "<!DOCTYPE html>\n";
    print "<html>\n";
    print "  <head>\n";
    print "    <meta charset=\"utf-8\" />\n";
    print "    <title>$titre</title>\n";
    print "    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>";
    print "    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css\">";
    print "    <link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.0.13/css/all.css\" integrity=\"sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp\" crossorigin=\"anonymous\">";

    print "    <link rel=\"stylesheet\" href=\"css/style.css\">";
    print "    <link rel=\"stylesheet\" href=\"css/header.css\">\n";
    print "    <link rel=\"stylesheet\" href=\"css/annonce.css\">\n";
    print "    <link rel=\"stylesheet\" href=\"css/sidebar.css\">\n";
    print "    <link rel=\"stylesheet\" href=\"css/login.css\">\n";
    print "    <link rel=\"stylesheet\" href=\"css/createForm.css\">\n";

    print "<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>";
    print "<script src=\"js/global.js\"></script>";
    print "  </head>\n";
  
    print "  <body>\n";
    print "    <header role=\"header\">\n";
    print "    <nav class=\"menu\" role=\"navigation\">\n";
    print "    <div class=\"inner\">\n";
    print "    <div class=\"m-left\">\n";
    print "    <h1 class=\"logo\">Les Bons Bails</h1>\n";
    print "    </div>\n";
    print "    <img class=\"logoImg\" src=\"images/logoLBB.bmp\">";
    print "    <div class=\"m-right\">\n";

    print "    <a href=\"main.php\" class=\"m-link\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i> Accueil</a>\n";
    if (verif_authent()) {
	//print "    <a href=\"createForm.php\" class=\"m-link\"><i class=\"far fa-newspaper\" aria-hidden=\"true\"></i> Annonces</a>\n";
	//print "    <a href=\"contact.php\" class=\"m-link\"><i class=\"fas fa-paper-plane\" aria-hidden=\"true\"></i> Contact</a>\n";
	buttonResearch();
	buttonLogout();
    } else {
	print "    <a href=\"apropos.php\" class=\"m-link\"><i class=\"fas fa-question-circle\" aria-hidden=\"true\"></i> A propos</a>\n";
	buttonLogin();
    }

    print "    </div>\n";
    print "    </div>\n";
/*        include("form.html");
*/
    print "    </nav>\n";
    print "    </header>\n";
}

function footer(){
    print "<footer>";
    print "<link rel=\"stylesheet\" href=\"public/css/normalize.css\">";
    print "<p>&copy; <b>2018 ENSIIE</b> | Skutnik . Chekour . Trachino . Meas | All Rights Reserved</p>";
    print "<script src=\"js/global.js\"></script>";
    print "</footer>";
    print "</body>";
    print "</html>";

}


function getoffers($semestre, $module, $matiere){
    $requete = "SELECT * FROM annonce"; //default
    if($semestre){ //on ajoute des parametres en fonction de la recherche
    if($module){
        if($matiere){
        $requete = $requete . " WHERE semestre = " . $semestre . " AND  module = " . $module." AND matiere = " . $matiere;
        }
        else
        $requete = $requete."  WHERE semestre = ".$semestre." AND  module = ".$module;
    }
    else
        $requete = $requete." WHERE semestre = ".$semestre;
    }
    else if($module){
    if($matiere){
        $requete = $requete." WHERE module = ".$module."AND matiere = ".$matiere;
    }
    else
        $requete = $requete." WHERE module = ".$module;
    }
    else if($matiere){
    $requete = $requete." WHERE matiere = ".$matiere;
    }
    print $requete;
    $reponse = Annonce::getAnnonces($requete);
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

function indexnotco($erreur = "") {
    print "<div class=annonce>";
    print "<div class=title> Bienvenue sur Les Bons Bails </div>";
    print "<br>";
    print "<div> <br> Connectez vous pour accéder aux offres ";
    if ($erreur != "")
	print "<br><span class=\"error\">Erreur: $erreur</span>";
    print "</div>";
    print "<br>";
    print "<br>";
    print "</div>";
}

function contactsuccess() {
    print "<div class=\"main\">";
    print "<h2>Nous contacter</h2>";
    print "<div class=annonce>";
    //print "<div class=title style=\"text-align:center;\"> Contact </div>";
    print "<div> <br> <br> <br> <br> <br> Pour prendre contact avec nos équipes, n'hésitez pas à nous faire signe par telephone <br> au <strong> 06 59 42 47 94 </strong> ou par mail à <strong>lesbonsbails@gmail.com</strong> <br> <br> <br> <br> <br> <br> </div>";
    print "</div>";
    print "</div>";
}

function contactfailure() {
    print "<div class=\"main\">";
    print "<div class=annonce>";
    print "<div class=title style=\"text-align:center;\"> Contact </div>";
    print "<div> <br> <br> <br> <br> <br> Connectez vous pour accéder a cette page. <br> <br> <br> <br> <br> <br> </div>";
    print "</div>";
    print "</div>";
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

function displayResearch() {
    include("form.html");
}

function buttonResearch() {
    echo "<a href=\"#research\" class=\"m-link\" id=\"research\"><i class=\"fas fa-search\" aria-hidden=\"true\"></i> Rechercher</a>";
}


?>
