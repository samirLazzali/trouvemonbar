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
head("mp.css","Aperal : Ajouter un ingredient");
_header();
?>
<body>
<div id="main">
    <div id="article_connection">
        <h1>Ajouter une recette</h1>
        <form action="ajouter_ing.php" method="post">
            <p style="text-align: center">
                Nom de l'ingredient :<input type="text" size="20" maxlength="18" name="ingredient"/>
                <br/>
                Prix de l'ingrédient:<input type="text" size="20" maxlength="18" name="prix"/>
                <br/>
            </p>
            <input type='submit' value='Valider' name='bouton_valider'/>
            <button type="button" ONCLICK="window.location.href='edition.php'">Annuler</button>
        </form>

    </div>
</div>
</body>
<?php
_footer();
?>
</html>