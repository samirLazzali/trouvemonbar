<?php
session_start();
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
include("affichage.php");
head("mp.css","Aperal : Ajouter une recette");
_header();
?>
<body>
<div id="main">
    <div id="article_connection">
        <?php
        if (empty($_POST['recette']) || empty($_POST['ingredients'])) {
            echo "<a href=\"ajout_recette.php\">échec : veillez à remplir correctement les champs recette et ingrédients</a>";
        }
        else {
            $ing = array();
            foreach ($_POST['ingredients'] as $i){
                $ing[]=$i;
            }
            $recette = $_POST['recette'];
            $temps=$_POST['temps'];
            $prix=$_POST['prix'];
            $descr=$_POST['description'];
            $connexion = db_connect();
            $ajout = ajouter($ing, $recette,$temps,$prix,$descr,$connexion);
            db_close($connexion);
            if ($ajout == true) {
                echo "<a href=\"index.php\">succès</a>";
            }
            else {
                echo "<a href=\"recette.php\">La recette existe déjà</a>";
            }
        }
        ?>
    </div>
</div>
</body>
<?php
_footer();
?>
</html>