<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <?php
        include("affichage.php");
        head("mp.css","Aperal : Connection");
        _header();
    ?>
    <body>
        <div id="main">
            <div id="article_connection">
                <?php
                    if (empty($_POST['pseudo']) || empty($_POST['pwd']) ) {
                        echo "<a href=\"connexion.php\">échec de la connection</a>";
                    }
                    else {
                        $surnom = $_POST['pseudo'];
                        $mdp = $_POST['pwd'];
                        $connexion = db_connect();
                        $connect = verif($surnom, $mdp,$connexion);
                        $rep = $connexion->query("SELECT id FROM \"user\" WHERE surname='$surnom'");
                        $tuple = $rep->fetch();
                        $rep=null;
                        db_close($connexion);
                        if ($connect == true) {
                            $_SESSION['logged']=true;
                            $_SESSION['pseudo']=$_POST['pseudo'];
                            $_SESSION['id']=$tuple['id'];
                            echo "<a href=\"index.php\">succès</a>";
                        }
                        else {
                            echo "<a href=\"connexion.php\">échec de la connection</a>";
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

