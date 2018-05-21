<!DOCTYPE html>
<html>
<?php
include("affichage.php");
$connecte=0;
head("mp.css","Aperal : Inscription");
_header();
?>
<body>
<div id="main">
    <div id="article_connection">
        <h1>Connection</h1>
        <form action="inscription_bd.php" method="post">
            <p>
                Pseudonyme : <input type="text" size="20" maxlength="18" name="pseudo"/>
                <br/>
                Nom : <input type="text" size="20" maxlength="18" name="nom"/>
                <br/>
                Prenom : <input type="text" size="20" maxlength="18" name="prenom"/>
                <br/>
                Mot de passe : <input type="password" size="20" maxlength="18" name="pwd"/>
                <br/>
                Répeter le mot de passe : <input type="password" size="20" maxlength="18" name="pwdbis"/>
                <br/>
                <input type="submit" value="Inscription" name="bouton_connection"/>
                <br/>
                <a href="connexion.php">Se connecter</a>
            </p>
        </form>
    </div>
</div>
</body>
<?php
_footer();
?>
</html>