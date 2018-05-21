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
head("mp.css","Aperal : Liste de course");
$liens = array(
    array("index.php","Page d'accueil"),
    array("stats.php","Statistiques et trésorerie"),
    array("myth.php","Mythologie"),
    array("course.php","Course"),
    array("recette.php","Recettes"),
    array("oenologie.php","Oenologie : A quand la prochaine réu ?"),
    array("contact.php","Nous contacter")
);
echo "<body>";
_header();
echo "<dib id=\"corps\">";
_nav($connecte,$liens);
echo "<div id=\"main\">";
echo "<div id ='article'>";
$recette = $_POST['recette'];
$connexion = db_connect();
$liste_ingredients_recettes = ingredients_recettes($connexion,$recette);
db_close($connexion);
echo "<h1>Ingrédients pour réaliser la recette $recette : </h1>";
echo "<p>";
echo "<ul>";
foreach ($liste_ingredients_recettes as $ing){
    echo "<li> $ing </li>";
}
echo "</ul>";
echo "</p>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</body>";
_footer();
?>
</html>