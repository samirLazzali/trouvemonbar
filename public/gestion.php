<?php
session_start();
$connecte=0;
if (isset($_SESSION['logged'])){
    $connecte = 1;
}
if ($connecte==0) {
    header("Location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<?php
include("affichage.php");
$connecte=0;
head("mp.css","Aperal : Gestion du compte");
_header();
?>
<body>
<div id="main">
    <div id="article_connection">
        <h1>Gestion du compte</h1>
        <p>
            <a href="change_mdp.php">Changer de mot de passe</a>
            <?php
            if ($_SESSION['id']==3){
                echo " | <a href='droits.php'>Gérer les droits</a>";
            }
            ?>

        </p>
    </div>
</div>
</body>
<?php
_footer();
?>
</html>