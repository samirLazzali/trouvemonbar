<?php

include "gestion_db.php";

/**
 * @brief génère l'entete, s'appelle au début du fichier
 * @param $titre une string
 */
function enTete($titre)
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

/**
 * @brief génère le pied, s'appelle à la fin
 */
function pied(){
    print "</body>";
    print "</html>";

}

/**
 * @brief affiche $str (pas forcement utile)
 * @param $str string
 */
function affiche($str) {
    echo $str;
}

/**
 * @brief affiche $str sous forme de paragraphe
 * @param $str une string
 */
function affiche_info($str) {
    echo '<p>'.$str.'</p>';
}

/**
 * @brief affiche $str sous forme de message d'erreur
 * @param $str une string
 */
function affiche_erreur($str) {
    echo '<p class="erreur">'.$str.'</p>';
}

/**
 * @brief crée l'entête html d'un fichier
 * @param $mp une feuille de style css, $titre une chaîne de caractère
 */
function head($mp,$titre){
    echo "<head>";
    echo "<meta charset=\"UTF−8\"/>";
    echo "<title>$titre</title>";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$mp\"/>";
    echo "</head>";
}

/**
 * @brief genère le corps d'une page web
 * @param $connecte un entier indiquant si l'utilisateur est connecté,$page ndiquant la page sur laquelle on se trouve
 */
function body($connecte,$liens,$page){
    echo "<body>";
    _header();
    echo "<dib id=\"corps\">";
    _nav($connecte,$liens);
    _main($page);
    echo "</div>";
    echo "</body>";
}

/**
 * @brief génére l'entête d'une page web
 */
function _header(){
    echo "<div id=\"header\">";
    echo  "<h1>Aperal</h1>";
    echo "</div>";
}

/**
 * @brief génére une barre de navigation
 * @param $connecte un entier indiquant si l'utilisateur est conneté, $liens un tableau de tableaux contenant les liens et leurs intitulés
 */
function _nav($connecte,$liens){
    echo  "<div id=\"nav\">";
    menu($liens);
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
 * @brief affiche une liste de liens pour la barre de navigation
 *  @param $liens un tableau de tableaux contenant les liens et leurs intitulés
 */
function menu($liens){
    $n=count($liens);
    echo "<div id=\"menu\">";
    echo "<h3>Aperal</h3>";
    echo "<p>";
    for($i=0;$i<$n;$i++){
        $lien=$liens[$i][0];
        $texte=$liens[$i][1];
        echo "<a href='$lien'>$texte</a></br>";
    }
    echo "</p>";
    echo "</div>";
}

/**
 * @brief génére le contenu principale d'une page
 * @param $page une page dont l'on veut générer le contenu
 */
function _main($page) {
    echo "<div id=\"main\">";
    if ($page == "index.php"){
        article_index();
    }
    if ($page == "course.php") {
        article_course();
    }
    if ($page == "liste.php") {
        article_liste();
    }
    if ($page == "myth.php") {
        article_myth();
    }
    if ($page == "recette.php") {
        article_recette();
    }
    if ($page == "contact.php") {
        article_contact();
    }
    if ($page == "stats.php") {
        article_stats();
    }
    if ($page == "oenologie.php") {
        article_oenologie();
    }
    echo "</div>";
}

/**
 * @brief affiche l'article de index.php
 */
function article_index(){
    echo "<div id=\"article\">";
    echo "<h1>Bienvenue sur le nouveau site d'Aperal</h1>";
    echo "</div>";
}

/**
 * @brief affiche l'article de course.php
 */
function article_course(){
    $connexion = db_connect();
    $recettes=recettes($connexion);
    db_close($connexion);
    echo "<div id ='article'>";
    echo "<h1>Quelle recette voulez vous preparer ?</h1>";
    echo "<p>";
    echo "<form action='liste.php' method='post'>";
    foreach ($recettes as $rec){
        echo "<input type=\"radio\" name='recette' value='$rec'/>$rec";
        echo "<br/>";
    }
    echo "<br/>";
    echo "<input type='submit' value='Valider' name='bouton_valider'/>";
    echo "</form>";
    echo "</p>";
    echo "</div>";
}

/**
 * @brief affiche l'article de myth.php
 */
function article_myth(){
    echo "<div id=\"article\">";
    echo "<h1>Mythologie</h1>";
    echo "</div>";
}

/**
 * @brief affiche l'article de contact.php
 */
function article_contact(){
    echo "<div id=\"article\">";
    echo "<h1>Nous contacter</h1>";
    echo "</div>";
}

/**
 * @brief affiche l'article de recette.php
 */
function article_recette(){
    $connexion = db_connect();
    $liste_recettes = recettes($connexion);
    db_close($connexion);
    echo "<div id=\"article\">";
    echo "<h1>Différentes recettes proposées par Apéral :</h1>";
    echo "<p>";
    echo "<ul>";
    foreach ($liste_recettes as $rec){
        echo "<li><strong><em>$rec</em></strong></li>";
        if ($rec=="Jacqueline") {
            echo "Mélanger le vin blanc avec de la limonade et du sirop de grenadine." ;
            echo "</br>";
        }
        if ($rec=="Pizza") {
            echo "Dérouler la pâte à pizza puis disposer successivement sur celle-ci jambon, sauce tomate et gruyère. 
            Puis enfournez 30 minutes à 210°" ;
            echo "</br>";
        }
        if ($rec=="feuillete_saucisse") {
            echo "Dérouler la pâte feuilletée et étaler de la moutarde sur celle-ci. 
            Couper la pâte en plusieurs morceaux et disposer sur chaue morceaux une saucisse cocktail.
            Enrouler enfin la saucisse avec le morceau de pâte. Faire cuire 15 à 20 minutes au four à 180°. " ;
            echo "</br>";
        }
        if ($rec=="Tartines_thon_StMoret") {
            echo "Mélanger une boite de thon avec une boite de St_Moret puis ajouter du citron. 
            Étaler enfin la préparation sur les toasts de pain que vous aurez dorés préalablement au four." ;
            echo "</br>";
        }
        if ($rec=="Roules_jambon_StMoret") {
            echo "Étaler le StMoret sur les tranches de jambon puis roulez celles-ci en formes de boudin. Coupez les enfin en
            6 afin de réaliser plusieurs bouchées.";
            echo "</br>";
        }
        echo "</br>";
    }
    echo "</ul>";
    echo "</p>";
    echo "</div>";
}

/**
 * @brief affiche l'article de stats.php
 */
function article_stats(){
    echo "<div id=\"article\">";
    echo "<h1>Statistiques et trésorerie</h1>";
    echo "</div>";
}

/**
 * @brief affiche l'article de oenologie.php
 */
function article_oenologie(){
    echo "<div id=\"article\">";
    echo "<h1>Oenologie : A quand la prochaine réunion ?</h1>";
    echo "</div>";
}

/**
 * @brief génére le pied de page
 */
function _footer(){
    echo"<div id=\"footer\">14/05/2018</div>";
}

?>