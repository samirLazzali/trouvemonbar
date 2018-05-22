<?php
session_start();
?>

<!DOCTYPE html>
<html>
<?php
include("affichage.php");
head("mp.css","Aperal : Inscription");
_header();
?>
<body>
<div id="main">
    <div id="article_connection">
        <?php
        if (empty($_POST['pseudo']) || empty($_POST['pwd']) || empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['pwdbis']) || ($_POST['pwd']!=$_POST['pwdbis'])) {
            echo "<a href=\"inscription.php\">échec de l'inscription : veillez à remplir correctement tous les champs</a>";
        }
        else {
            $surnom = $_POST['pseudo'];
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $mdp = $_POST['pwd'];
            $connexion = db_connect();
            $inscrit = inscript($surnom, $prenom,$nom,$mdp,$connexion);
            db_close($connexion);
            if ($inscrit == 1) {
                $_SESSION['logged']=true;
                $_SESSION['pseudo']=$_POST['pseudo'];
                $_SESSION['id']=1;
                echo "<a href=\"index.php\">succès</a>";
            }
            else {
                echo "<a href=\"inscription.php\">Veuillez changez votre surnom</a>";
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