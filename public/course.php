<!DOCTYPE html>
<html>
    <?php
        include("affichage.php");
        $connecte=0;
        head("mp.css","Aperal : Liste de course");
        $liens = array(
                    array("index.php","Page d'accueil"),
                    array("stats.php","Statistiques et trésorerie"),
                    array("myth.php","Mythologie"),
                    array("recette.php","Recettes"),
                    array("oenologie.php","Oenologie : A quand la prochaine réu ?"),
                    array("contact.php","Nous contacter")
                    );
        body($connecte,$liens,"course.php");
        _footer();
    ?>
</html>