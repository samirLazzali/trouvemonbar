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
    head("mp.css","Aperal : Statistiques");
    $liens = array(
            array("index.php","Page d'accueil"),
            array("myth.php","Mythologie"),
            array("recette.php","Recettes"),
            array("course.php","Liste de course"),
            array("oenologie.php","Oenologie "),
            array("contact.php","Nous contacter")
            );
    echo "<body>";
    _header();
    echo "<dib id=\"corps\">";
    _nav($connecte,$liens);
    $connexion = db_connect();
    $liste_soiree = soiree($connexion);
    db_close($connexion);
    echo "<div id=\"main\">";
    echo "<div id=\"article\">";
    if (isset($_SESSION['id'])&&($_SESSION['id']==1)){
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
    echo "</div>";
    echo "</div>";
    echo "</body>";
        _footer();
    ?>
</html>