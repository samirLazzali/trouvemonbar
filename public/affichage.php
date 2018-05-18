<?php
/**
 *
 */
function pied(){
    print "</body>";
    print "</html>";

}

/**
 * @param $str
 */
function affiche($str) {
    echo $str;
}

/**
 * @param $str
 */
function affiche_info($str) {
    echo '<p>'.$str.'</p>';
}

/**
 * @param $str
 */
function affiche_erreur($str) {
    echo '<p class="erreur">'.$str.'</p>';
}

/**
 * @param $mp
 */
function head($mp){
    echo "<head>";
    echo "<meta charset=\"UTF−8\"/>";
    echo "<title>Aperal</title>";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$mp\"/>";
    echo "</head>";
}

/**
 * @param $connecte
 */
function body($connecte){
    echo "<body>";
    _header();
    echo "<dib id=\"corps\">";
    _nav($connecte);
    _main();
    echo "</div>";
    echo "</body>";
}

/**
 *
 */
function _header(){
    echo "<div id=\"header\">";
    echo  "<h1>Aperal</h1>";
    echo "</div>";
}

/**
 * @param $connecte
 */
function _nav($connecte){
    echo  "<div id=\"nav\">";
    menu();
    if ($connecte==1) {
        profil();
    }
    else {
        echo "<button type=\"button\" ONCLICK=\"window.location.href='connexion.php'\">Se connecter</button>";
    }
    echo "</div>";
}

/*TODO*/
function profil(){
    echo "<div id=\"menu\">";
    echo "<h3>Profil</h3>";
    echo "<p>Afficher les détails du profil à l'aide de la bd</p>";
    echo "</div>";
}

/**
 *
 */
function menu(){
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
}

/**
 *
 */
function _main() {
    echo "<div id=\"main\">";
    _article();
    echo "</div>";
}

/**
 *
 */
function _article(){
    echo "<div id=\"article\">";
    echo "<h1>Bienvenu sur le nouveau site d'Aperal</h1>";
    echo "</div>";
}

/**
 *
 */
function _footer(){
    echo"<div id=\"footer\">14/05/2018</div>";
}

?>