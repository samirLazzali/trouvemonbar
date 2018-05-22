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
$connecte=0;
head("mp.css","Aperal : Changement des droits les droits");
_header();
?>
<body>
<div id="main">
    <div id="article_connection">
        <h1>Gestion des droits</h1>
        <form action="change_droits.php" method="post">
            <p>
                Surnom : <input type="text" size="20" maxlength="18" name="pseudo"/>
                <br/>
                Droit à attribuer :
                <input type="radio" name="droit" value="1"/>Visiteur
                <input type="radio" name="droit" value="2"/>Membre
                <input type="radio" name="droit" value="3"/>Administrateur
                <br/>
                <input type="submit" value="Valider" name="bouton_validation"/>
            </p>
        </form>
    </div>
</div>
</body>
<?php
_footer();
?>
</html>