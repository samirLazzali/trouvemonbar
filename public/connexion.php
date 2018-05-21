<!DOCTYPE html>
<html>
    <?php
        include("affichage.php");
        $connecte=0;
        head("mp.css","Aperal : Connection");
        _header();
    ?>
    <body>
        <div id="main">
            <div id="article_connection">
                <h1>Connection</h1>
                <form action="verification.php" method="post">
                    <p>
                        Pseudonyme : <input type="text" size="20" maxlength="18" name="pseudo"/>
                        <br/>
                        Mot de passe : <input type="password" size="20" maxlength="18" name="pwd"/>
                        <br/>
                        <input type="submit" value="Connection" name="bouton_connection"/>
                        <br/>
                        <a href="inscription.php">S'inscrire</a>
                    </p>
                </form>
            </div>
        </div>
    </body>
    <?php
        _footer();
    ?>
</html>