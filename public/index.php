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
        head("mp.css","Aperal : Accueil");
        $liens = array(
                    array("stats.php","Statistiques et trésorerie"),
                    array("myth.php","Mythologie"),
                    array("recette.php","Recettes"),
                    array("course.php","Liste de course"),
                    array("oenologie.php","Oenologie "),
                    array("contact.php","Nous contacter")
                    );
        body($connecte,$liens,"index.php");
        _footer();
    ?>
</html>