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
head("mp.css","Aperal : Changement du mot de passe");
_header();
?>
<body>
<div id="main">
    <div id="article_connection">
        <?php
        if (empty($_POST['pwd']) || empty($_POST['pwd_bis']) || ($_POST['pwd']!=$_POST['pwd_bis'])) {
            echo "<a href=\"change_mdp.php\">Veillez à bien remplir les champs</a>";
        }
        else {
            $mdp = $_POST['pwd'];
            $connexion = db_connect();
            $chang = modif_mp($mdp,$connexion,$_SESSION['pseudo']);
            db_close($connexion);
            if ($chang == true) {
                echo "<a href=\"index.php\">succès</a>";
            }
            else {
                echo "<a href=\"change_mdp.php\">échec</a>";
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