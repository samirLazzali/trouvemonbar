<?php
session_start();
$connecte=0;
if (isset($_SESSION['logged'])){
    $connecte = 1;
}
if ($connecte==0 || ($_SESSION['id']!=3)) {
    header("Location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<?php
include("affichage.php");
head("mp.css","Aperal : Changement des droits");
_header();
?>
<body>
<div id="main">
    <div id="article_connection">
        <?php
        if (empty($_POST['pseudo']) || empty($_POST['droit'])) {
            echo "<a href=\"droits.php\">Veillez à bien remplir les champs</a>";
        }
        elseif ($_SESSION['pseudo']==$_POST['pseudo']){
            echo "<a href=\"droits.php\">Vous ne pouvez pas changer vos propres droits</a>";
        }
        else {
            $pseudo=$_POST['pseudo'];
            $droit=$_POST['droit'];
            $connexion = db_connect();
            $chang = modif_droit($pseudo,$droit,$connexion);
            db_close($connexion);
            if ($chang == true) {
                echo "<a href=\"index.php\">succès</a>";
            }
            else {
                echo "<a href=\"droits.php\">échec</a>";
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