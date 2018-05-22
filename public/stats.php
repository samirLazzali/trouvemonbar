<?php
session_start();
include("affichage.php");
$connecte=0;
if (isset($_SESSION['logged'])){
    $connecte = 1;
}
if ($connecte==0){
    header("Location:connexion.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<?php
        head("mp.css","Aperal : Statistiques");
        $liens = array(
            array("index.php","Page d'accueil"),
            array("myth.php","Mythologie"),
            array("recette.php","Recettes"),
            array("course.php","Liste de course"),
            array("oenologie.php","Oenologie : A quand la prochaine réu ?"),
            array("contact.php","Nous contacter")
            );
        body($connecte,$liens,"stats.php");
        _footer();
    ?>
</html>