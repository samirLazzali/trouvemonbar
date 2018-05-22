<?php
session_start();
?>

<!DOCTYPE html>
<html>
<?php
include("affichage.php");
$connecte=0;
if (isset($_SESSION['logged'])){
    $connecte = 1;
}
        head("mp.css","Aperal : Recettes");
        $liens = array(
            array("index.php","Page d'accueil"),
            array("stats.php","Statistiques et trésorerie"),
            array("myth.php","Mythologie"),
            array("course.php","Liste de course"),
            array("oenologie.php","Oenologie : A quand la prochaine réu ?"),
            array("contact.php","Nous contacter")
        );
echo "<body>";
_header();
echo "<dib id=\"corps\">";
_nav($connecte,$liens);
echo "<div id=\"main\">";
echo "<div id ='article'>";
echo "<div id=\"article\">";
echo "<h1><p style=\"text-indent:7em\">Différentes recettes proposées par Apéral :</h1>";
echo "<p>";
$connexion = db_connect();
$liste_recettes = descr_recettes($connexion);
db_close($connexion);
echo "</p>";
 if ($_SESSION['id']==3){
    echo "<button type=\"button\" ONCLICK=\"window.location.href='ajout_recette.php'\">Ajouter une recette</button>";
}
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</body>";
_footer();
    ?>
</html>