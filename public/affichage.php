<?php

function head($mp){
    echo "<head>";
    echo "<meta charset=\"UTF−8\"/>";
    echo "<title>Aperal</title>";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$mp\"/>";
    echo "</head>";
}

function body(){
    echo "<body>";
    _header();
    echo "<dib id=\"corps\">";
    _nav();
    _article();
    echo "</div>";
    echo "</body>";
}

function _header(){
    echo "<div id=\"header\">";
    echo  "<h1>Aperal</h1>";
    echo "</div>";
}

function _nav(){
    echo  "<div id=\"nav\">";
    echo "<div id=\"menu\">";
    echo "<h3>Aperal</h3>";
    echo "<p>";
    echo "<a href=\"stats.php\">Statistiques et trésorerie</a></br>";
    echo "<a href=\"myth.php\">Mythologie</a></br>";
    echo "<a href=\"recette.php\">Recettes</a></br>";
    echo "<a href=\"course.php\">Liste de course</a></br>";
    echo "<a href=\"oenologie.php\">Oenologie : A quand la prochaine réu ?</a></br>";
    echo "<a href=\"course.php\">Nous contacter</a></br>";
    echo "</p>";
    echo "</div>";
    echo "</div>";
}

function _article() {
    echo "<div id=\"article\">";
    echo "<h1>Bienvenu sur le nouveau site d'Aperal</h1>";
    echo "</div>";
}

function _footer(){
    echo"<div id=\"footer\">14/05/2018</div>";
}

?>