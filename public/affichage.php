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
    echo "<p>";
    $pseudo=$_SESSION['pseudo'];
    $connection=db_connect();
    $requete="SELECT surname,firstname,lastname,id FROM \"user\" WHERE surname='$pseudo'";
    $reponse=$connection->query($requete);
    $tuple=$reponse->fetch();
    $prenom=$tuple['firstname'];
    $surnom=$tuple['surname'];
    $nom=$tuple['lastname'];
    $id=$tuple['id'];
    $reponse=null;
    db_close($connection);
    echo "$prenom \"$surnom\" $nom<br/>";
    if ($id==1){
        echo "rang : visiteur";
    }
    if ($id==2){
        echo "rang : membre";
    }
    if ($id==3){
        echo "rang : administrateur";
    }
    echo "<br/><a href='gestion.php'>Gérer</a>";
    echo "</p>";
    echo "<button type=\"button\" ONCLICK=\"window.location.href='deconnection.php'\">Deconnection</button>";
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
    echo "<h1><p style=\"text-indent:7em\">Bienvenue sur le nouveau site d'Aperal!</h1></br>";

    echo"<body><img src='images/logo.png' alt='logo' />
    <p>Aaah! Un petit verre, un peu de saucisson et quelques chips entre
    amis, quoi de mieux pour se détendre ?</p>
    <p>A Aperal, on s’occupe de donner à tout le monde un peu de bonne
 humeur, avec du saucisson bien sûr. Un bon moment de convivialité à
    consommer sans modération.</p>
    <p>Avant chaque soirée, place à la préparation, et pour nous, c’est faire l’apéro de l’apéro !
 Parce que préparer plein de bonnes choses, c’est bien, mais vérifier la qualité c’est essentiel.    </p>
    <p>L’apéro est un art, viens nous faire profiter de tes connaissances ! </p></body>";
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
    echo "<h1><p style=\"text-indent:7em\">Quelle recette voulez vous preparer ?</h1>";
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
    echo "<h1><p style=\"text-indent:12em\">Mythologie</h1>";
    echo "</br>";
    echo "</br>";
    echo "<p> <strong> Bureau 2017-2018 : </strong>";
    echo "<p style=\"text-indent:2em\"> Président : <em>Pichet</em> </br> ";
    echo "<p style=\"text-indent:2em\">Vice-prez : <em>Patou & Derien</em> </br>";
    echo "<p style=\"text-indent:2em\"> Sec-gen : <em>Vic</em>  </br>";
    echo "<p style=\"text-indent:2em\">Trésorier : <em>Simsim</em> </br>";
    echo "</br>";
    echo "</br>";
    echo "<p> <strong> Bureau 2016-2017 : </strong>";
    echo "<p style=\"text-indent:2em\"> Président : <em>JM</em> </br> ";
    echo "<p style=\"text-indent:2em\">Vice-prez : <em>Monaco & Boucher</em> </br>";
    echo "<p style=\"text-indent:2em\"> Sec-gen : <em>Riner</em>  </br>";
    echo "<p style=\"text-indent:2em\">Trésorier : <em>Jacqueline</em> </br>";
    echo "</br>";
    echo "</br>";
    echo "<p> <strong> Bureau 2015-2016 : </strong>";
    echo "<p style=\"text-indent:2em\"> Président : <em>Omega</em> </br> ";
    echo "<p style=\"text-indent:2em\">Vice-prez : <em>Croustimoufle & Brick</em> </br>";
    echo "<p style=\"text-indent:2em\"> Sec-gen : <em>Choucroute</em>  </br>";
    echo "<p style=\"text-indent:2em\">Trésorier : <em>Onyx</em> </br>";
    echo "</br>";
    echo "</br>";
    echo "<p> <strong> Bureau 2014-2015 : </strong>";
    echo "<p style=\"text-indent:2em\"> Président : <em>Ashou</em> </br> ";
    echo "<p style=\"text-indent:2em\">Vice-prez : <em>Corto & Fox</em> </br>";
    echo "<p style=\"text-indent:2em\"> Sec-gen : <em>Omega</em>  </br>";
    echo "<p style=\"text-indent:2em\">Trésorier : <em>Stif</em> </br>";
    echo "</br>";
    echo "</br>";
    echo "<p> <strong> Bureau 2013-2014 : </strong>";
    echo "<p style=\"text-indent:2em\"> Président : <em>Gamin</em> </br> ";
    echo "<p style=\"text-indent:2em\">Vice-prez : <em>Vaiselle & frtoms</em> </br>";
    echo "<p style=\"text-indent:2em\"> Sec-gen : <em>Inco</em>  </br>";
    echo "<p style=\"text-indent:2em\">Trésorier : <em>Chuck</em> </br>";
    echo "</br>";
    echo "</br>";
    echo "<p> <strong> Bureau 2012-2013 : </strong>";
    echo "<p style=\"text-indent:2em\"> Président : <em>BN</em> </br> ";
    echo "<p style=\"text-indent:2em\">Vice-prez : <em>Pichu & LeBelge</em> </br>";
    echo "<p style=\"text-indent:2em\"> Sec-gen : <em>Booster</em>  </br>";
    echo "<p style=\"text-indent:2em\">Trésorier : <em>Mosdef</em> </br>";
    echo "</br>";
    echo "</br>";
    echo "<p> <strong> Bureau 2011-2012 : </strong>";
    echo "<p style=\"text-indent:2em\"> Président et Fondateur : <em>Leni</em> </br> ";
    echo "<p style=\"text-indent:2em\">Vice-prez : <em>Hippod & Eric</em> </br>";
    echo "<p style=\"text-indent:2em\"> Sec-gen : <em>Prince Caramel</em>  </br>";
    echo "<p style=\"text-indent:2em\">Trésorier : <em>Loki</em> </br>";
    echo "</div>";
}

/**
 * @brief affiche l'article de contact.php
 */
function article_contact(){
    echo "<div id=\"article\">";
    echo "<h1><p style=\"text-indent:12em\">Nous contacter</h1>";
    echo "<p>Président : Quentin \"Pichet\"Pichollet<br/>email : quentin.pichollet@ensiie.fr</p>";
    echo "</div>";
}

/**
 * @brief affiche l'article de recette.php
 */
function article_recette(){
    echo "<div id=\"article\">";
    echo "<h1><p style=\"text-indent:7em\">Différentes recettes proposées par Apéral :</h1>";
    echo "<p>";
    $connexion = db_connect();
    $liste_recettes = descr_recettes($connexion);
    db_close($connexion);
    echo "</p>";
    if (isset($_SESSION['ip']) && ($_SESSION['ip']==3)){
        echo "<button type=\"button\" ONCLICK=\"window.location.href='edition.php'\">Editer base de donnée</button>";

    }
    echo "</div>";
}

/**
 * @brief affiche l'article de stats.php
 */
function article_stats(){
    $connexion = db_connect();
    $liste_soiree = soiree($connexion);
    db_close($connexion);
    $id = $_SESSION['id'];
    echo "<div id=\"article\">";
    if ($id==1){
        echo "<p>Vous devez être membre pour accéder à cette page</p>";
    }
    else {
        echo "<h1><p style=\"text-indent:10em\">Statistiques et trésorerie</h1>";
        echo "<table>";
        echo "<tr><th>Soirée</th><th>Nombre d'assiettes vendues</th><th>Cout achat</th><th>Revenus</th><th>Bénéfice</th></tr>";
        foreach ($liste_soiree as $soiree) {
            $connexion = db_connect();
            $liste_stats = statistique($connexion, $soiree);
            db_close($connexion);
            echo "<tr><td>$soiree</td><td>$liste_stats[2]</td><td>$liste_stats[3]</td><td>$liste_stats[4]</td>
        <td>$liste_stats[5]</td></tr>";
        }
        echo "</table>";
    }
    echo "</div>";
}

/**
 * @brief affiche l'article de oenologie.php
 */
function article_oenologie(){
    echo "<div id=\"article\">";
    echo "<h1><p style=\"text-indent:6em\">Oenologie : A quand la prochaine réunion ?</h1>";
    echo "</div>";
}

/**
 * @brief génére le pied de page
 */
function _footer(){
    echo"<div id=\"footer\">14/05/2018</div>";
}

?>