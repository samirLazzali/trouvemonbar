<!DOCTYPE html>
<html>
    <?php
        include("affichage.php");
        $connecte=0;
        head("mp.css","Aperal : Accueil");
        $liens = array(
                    array("stats.php","Statistiques et trésorerie"),
                    array("myth.php","Mythologie"),
                    array("recette.php","Recettes"),
                    array("course.php","Liste de course"),
                    array("oenologie.php","Oenologie : A quand la prochaine réu ?"),
                    array("contact.php","Nous contacter")
                    );
        body($connecte,$liens);
        _footer();
    ?>
</html>