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

function indexco(){

}

function indexnotco(){
	print "<h1> Bienvenue chez les bons bails! </h1>"
	print "<p> lorem ipsum .... </br>
				Connectez vous pour accéder aux offres 
		</p>"
	print "<p class='connexion'>

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
