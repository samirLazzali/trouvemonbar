<?php

session_start();

include("vue.php");
include ("recetteView.php");
include ("id_recette.php");
include("model.php");
if (!isset($_GET['recette'])){
    $bdd=db_connect();
    $count=$bdd->query('SELECT count(*) FROM recette');
    $max=$count->fetch()['count'];
    $idrecet=rand(1,$max-1);
}
else {
    $idrecet = $_GET['recette'];
}
$recet=recette($idrecet);
$ingredient=listeIngredients($idrecet);
$qte=listeQuantite($idrecet);
?>

<!doctype html>
  <html>

    <head>

      <meta charset="utf-8">
      <meta name="viewport" content="initial-scale=1.0">
      <title>Recette</title>
      <link href="http://fonts.googleapis.com/css?family=Ubuntu:400,400|Montserrat:400,700" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="css/standardize.css">
      <link rel="stylesheet" href="css/recette-grid.css">
      <link rel="stylesheet" href="css/recette.css">

    </head>

    <body class="body page-recette clearfix">

    <?php
    $pseudo = NULL;
    if (isset($_SESSION["pseudo"])){
        $pseudo = $_SESSION["pseudo"];
    }
    head($pseudo);
    ?>
      <section class="recette clearfix">

        <?php printpresentation($recet) ?>

        <?php printingredients($ingredient,$qte)?>


        <div class="description"></div>

      </section>

      <p class="description description-2">Description de la réalisation de la recette :
      <?php print $recet['description'] ?></p>

      <footer class="contact clearfix">

        <div class="reseau clearfix">
          <div class="facebook"></div>
          <div class="twitter"></div>
          <div class="discord"></div>
        </div>

        <div class="adresse">
          <p>1, square de la résistance</p>
          <p>91000 Evry</p>
        </div>

      </footer>

    </body>
    
  </html>