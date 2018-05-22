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
if ($_SESSION['id']!=3){
    header("Location:index.php");
    exit();
}
head("mp.css","Aperal : Ajouter une recette");
_header();
?>
<!DOCTYPE html>
<html>
<?php
head("mp.css","Aperal : Edition");
_header();
?>
<body>
<div id="main">
    <div id="article_connection">
        <h1>Edition de la basse de données</h1>
        <button style="margin-top: 3em" type=\"button\" ONCLICK="window.location.href='ajout_recette.php'">Ajouter une recette</button>
        <button style="margin-top: 3em" type=\"button\" ONCLICK="window.location.href='ajout_ingredient.php'">Ajouter un ingrédient</button>
        <br/>
        <button style="margin-top: 3em" type="button" ONCLICK="window.location.href='recette.php'">Annuler</button>
    </div>
</div>
</body>
<?php
_footer();
?>
</html>