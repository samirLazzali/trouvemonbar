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
if ($_SESSION['id']!=3){
    header("Location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<?php
include("affichage.php");
head("mp.css","Aperal : Ajouter un ingrédient");
_header();
?>
<body>
<div id="main">
    <div id="article_connection">
        <?php
        if (empty($_POST['ingredient']) || empty($_POST['prix'])) {
            echo "<a href=\"ajout_ingredient.php\">échec : veillez à remplir correctement les champs</a>";
        }
        else {
            $ing = $_POST['ingredient'];
            $prix=$_POST['prix'];
            $connexion = db_connect();
            $ajout = ajouter_ing($ing, $prix,$connexion);
            db_close($connexion);
            if ($ajout == true) {
                echo "<a href=\"index.php\">succès</a>";
            }
            else {
                echo "<a href=\"edition.php\">L'ingrédient existe déjà</a>";
            }
        }
        ?>
    </div>
</div>
</body>
<?php
_footer();
?>
