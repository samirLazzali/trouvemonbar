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
?>
<!DOCTYPE html>
<html>
<?php
head("mp.css","Aperal : Changement de mot de passe");
_header();
?>

<body>
<div id="main">
    <div id="article_connection">
        <h1>Changement du mot de passe</h1>
        <form action="changement_mdp.php" method="post">
            <p>
                Nouveau mot de passe : <input type="password" size="20" maxlength="18" name="pwd"/>
                <br/>
                Répeter le mot de passe : <input type="password" size="20" maxlength="18" name="pwd_bis"/>
                <br/>
                <input type="submit" value="Valider" name="bouton_connection"/>
                <button type="button" ONCLICK="window.location.href='index.php'">Annuler</button>
            </p>
        </form>
    </div>
</div>
</body>
<?php
_footer();
?>
</html>