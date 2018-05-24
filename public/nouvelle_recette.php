<?php

session_start();

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0">
    <title>index</title>
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,400|Kite+One:400,400" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/standardize.css">
    <link rel="stylesheet" href="css/index-grid.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body class="body page-index clearfix">
<div class="photo_accroche clearfix">
    <header class="cuisine clearfix">
        <div class="logo"></div>
        <p class="accroche">L'association des fins gourmets de l'ENSIIE !</p>
        <?php
        if(!isset($_SESSION['membre_id']))
        {
            ?>
            <div onClick="window.location.href='./membres/connexion.php';" class="connexion connexion-1 clearfix">
                <p class="connexion">Connexion</p>
            </div>
            <div onClick="window.location.href='./membres/inscription.php';" class="inscription inscription-1 clearfix">
                <p class="inscription">Inscription</p>
            </div>
            <?php
        }
        else
        {
            ?>
            <div onClick="window.location.href='./membres/moncompte.php';" class="connexion connexion-1 clearfix">
                <p class="connexion">Mon compte</p>
            </div>
            <div onClick="window.location.href='./membres/deconnexion.php';" class="connexion connexion-1 clearfix">
                <p class="connexion">Deconnexion</p>
            </div>
            <?php
        }
        ?>



        <nav class="navigation clearfix">
            <div onClick="window.location='index.php';" class="accueil accueil-1 clearfix">
                <p class="accueil">Accueil</p>
            </div>
            <div onClick="window.location='menu.php';" class="menu menu-1 clearfix">
                <p class="menu">Menu</p>
            </div>
            <div onClick="window.location='reservation.php';" class="reservation reservation-1 clearfix">
                <p class="reservation">Réservation</p>
            </div>
            <div onClick="window.location='catalogue.php';" class="recettes recettes-1 clearfix">
                <p class="recettes">Recettes</p>
            </div>
        </nav>
    </header>

    </div>
    <section class="nouvelle_recette clearfix">
    <div class="bandeau clearfix">
      <p class="ligne_gauche">__________________________________________________</p>
      <h2 class="titre_bandeau">Proposition de Recette</h2>
      <p class="ligne_droite">___________________________________________________</p>
    </div>

<?php
if(isset($_SESSION['membre_id']))
{

if (isset($_SESSION['proposition']) && $_SESSION['proposition']) {
    echo '<p class="valide clearfix"> Vous avez bien enregistré la recette </p>';
}

?>

        <div class="proposition clearfix">

            <form action="enregistrement_recette.php" method="POST">

                <p class="id_author id_author-1">Auteur :</p>
                <input class="id_author id_author-2" placeholder="Nom de l'auteur." type="text" name="id_auteur">

                <p class="t t-1">Quel est le type de la recette ?</p>
                <br/>
                <input type="radio" name="id_type" value="0" id="zero_type">
                <label for="0">Boisson</label><br>
                <input type="radio" name="id_type" value="1" id="un_type">
                <label for="1">Entrée</label><br><br>
                <input type="radio" name="id_type" value="2" id="deux_type">
                <label for="2">Plat</label><br>
                <input type="radio" name="id_type" value="3" id="trois_type">
                <label for="3">Dessert</label><br><br>

                <p class="titre titre-1">Titre :</p>
                <input class="titre titre-2" placeholder="Titre de la recette." type="text" name="titre">

                <p class="ingredient ingredient-1">Ingrédients :</p>
                <input class="ingredient ingredient-2"
                       placeholder="ingrédient 1, ingrédient 2, ingrédient 3, ingrédient 4, ..." type="text"
                       name="ingredients">

                <p class="instructions instructions-1">Instructions :</p>
                <input class="instructions instructions-2" placeholder="Instructions pour la préparation de la recette."
                       type="text" name="instructions">
                <br/>

                <p class="t t-1">La recette a-t-elle déjà été faite ?</p>
                <br/>
                <input type="radio" name="done" value="0" id="zero">
                <label for="0">Jamais faite</label><br>
                <input type="radio" name="done" value="1" id="un">
                <label for="1">Faite en Jeudi Cuisine</label><br><br>
                <input type="radio" name="done" value="2" id="deux">
                <label for="2">Faite en soirée</label><br>
                <input type="radio" name="done" value="3" id="trois">
                <label for="3">Autre</label><br><br>

                <p class="t t-1">La recette sera visible par :</p>
                <br/>
                <input type="radio" name="pub" value="0" id="zero_pub">
                <label for="0">Publique</label><br>
                <input type="radio" name="pub" value="1" id="un_pub">
                <label for="1">Seulement visible par l'ENSIIE</label><br><br>
                <input type="radio" name="pub" value="2" id="deux_pub">
                <label for="2">Seulement visible par les membres de CuIsInE</label><br/>

                <button class="_button">Proposer</button>

            </form>
            <?php
            }
            else
            {
                ?>
                <div class="proposition clearfix">
                <p> Vous êtes deconnecté</p>
                </div>
<?php
            }
        ?>

    </div>
  </section>
  <footer class="cuisine cuisine-2 clearfix">
    <p class="adresse">1, square de la Résistance</p>
    <p class="code_postal">91000 Evry</p>
  </footer>
</body>
</html>