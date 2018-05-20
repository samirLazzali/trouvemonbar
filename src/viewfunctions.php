<?php
include ("login/login.php");

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
    print "  </head>\n";
  
    print "  <body>\n";
    print "    <header role=\"header\">\n";
    print "    <nav class=\"menu\" role=\"navigation\">\n";
    print "    <div class=\"inner\">\n";
    print "    <div class=\"m-left\">\n";
    print "    <h1 class=\"logo\">Les Bons Bails</h1>\n";
    print "    </div>\n";
    print "    <div class=\"m-right\">\n";

    print "    <a href=\"main.php\" class=\"m-link\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i> Accueil</a>\n";
    print "    <a href=\"apropos.php\" class=\"m-link\"><i class=\"fas fa-question-circle\" aria-hidden=\"true\"></i> A propos</a>\n";
    if (verif_authent()) {
	print "    <a href=\"createForm.php\" class=\"m-link\"><i class=\"far fa-newspaper\" aria-hidden=\"true\"></i> Annonces</a>\n";
	print "    <a href=\"contact.php\" class=\"m-link\"><i class=\"fas fa-paper-plane\" aria-hidden=\"true\"></i> Contact</a>\n";
	buttonResearch();
	buttonLogout();
    } else {
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

function indexnotco() {
	print "<div class=\"main\">";
    print "<div class=annonce>";
    print "<div class=title> Bienvenue sur Les Bons Bails </div>";
	print "<div> <br> Connectez vous pour accéder aux offres 
			</div>";
	print "<p class='connexion'> Connectez-Vous! </p>"; // dans les styles mettre que class connexion ouvre onclick() auth()

}

function contactsuccess() {
    print "<div class=\"main\">";
    print "<div class=annonce>";
    print "<div class=title> Contact </div>";
    print "<div> <br> <br> <br> <br> <br> Pour prendre contact avec nos équipes, n'hésitez pas à nous faire signe par telephone <br> au <strong> 06 59 42 47 94 </strong> ou par mail à <strong>lesbonsbails@gmail.com</strong> <br> <br> <br> <br> <br> <br> </div>";
    print "</div>";
    print "</div>";
}

function contactfailure() {
    print "<div class=\"main\">";
    print "<div class=annonce>";
    print "<div class=title> Contact </div>";
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
    echo "<div id=\"formresearch\" class=\"formresearch\" style=display:none>";
    echo "<div class=\"tab-content\">";
    echo "<h1>Recherchez votre solution</h1>";
    include("form.html");
    echo "<div id=\"signup\">";
    echo "<h1>Sign Up for Free</h1>";
    echo "<form action=\"recherche.php\" method=\"post\">";
    echo "<div class=\"field-wrap\">";
    echo "<label>Email Address<span class=\"req\">*</span></label>";
    echo "<input type=\"email\" name=\"email\" required=\"\" autocomplete=\"off\">";
    echo "</div>";
    echo "<div class=\"field-wrap\">";
    echo "<label>Set A Password<span class=\"req\">*</span></label>";
    echo "<input type=\"password\" name=\"password\" required=\"\" autocomplete=\"off\">";
    echo "</div><span class=\"errorDisp\"><?php echo \"Error: \$error\"; ?></span>";
    echo "<button type=\"signup\" class=\"button button-block\" name=\"signup\">Get Started</button>";
    echo "</form>";
    echo "</div>";
    echo "</div><!-- tab-content -->";
    echo "</div><!-- /form -->";
    echo "<script src=\"js/research.js\"></script>";
}
function buttonResearch() {
    echo "<a href=\"#research\" class=\"m-link\" id=\"research\"><i class=\"fas fa-sign-in-alt\" aria-hidden=\"true\"></i> Research</a>";
}


?>
