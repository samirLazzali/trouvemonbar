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
head("mp.css","Aperal : Ajouter une recette");
_header();
?>
<body>
<div id="main">
    <div id="article_connection">
        <h1>Ajouter une recette</h1>
        <form action="ajouter.php" method="post">
            <p style="text-align: left">
                Nom de la recette :<input type="text" size="20" maxlength="18" name="recette"/>
                <br/>
                Temps de préparation :<input type="text" size="20" maxlength="18" name="temps"/>
                <br/>
                Prix :<input type="text" size="20" maxlength="18" name="prix"/>
                <br/>
                Ingrédients :
                <br/>
                <?php
                $connexion = db_connect();
                $ingredients=ingredient($connexion);
                db_close($connexion);
                foreach ($ingredients as $ing){
                    echo "<input type='checkbox' name='ingredients[]' value='$ing'/>$ing";
                    echo "<br/>";
                }
                ?>
                Description de la recette :<br/><textarea name="description" cols="50" rows="5"></textarea>
                <br/>
            </p>
            <input type='submit' value='Valider' name='bouton_valider'/>
        </form>
        <button type="button" ONCLICK="window.location.href='recette.php'">Annuler</button>
    </div>
</div>
</body>
<?php
_footer();
?>
</html>