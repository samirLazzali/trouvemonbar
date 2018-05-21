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
        body($connecte,$liens,"recette.php");
        _footer();
    ?>
</html>