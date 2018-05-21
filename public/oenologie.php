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
        head("mp.css","Aperal : Oenologie");
        $liens = array(
            array("index.php","Page d'accueil"),
            array("stats.php","Statistiques et trésorerie"),
            array("myth.php","Mythologie"),
            array("recette.php","Recettes"),
            array("course.php","Liste de course"),
            array("contact.php","Nous contacter")
        );
        body($connecte,$liens,"oenologie.php");
        _footer();
    ?>
</html>