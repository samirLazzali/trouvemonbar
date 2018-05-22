<?php
include "vue.php";
session_start();
?>

<!doctype html>
  <html>
  
    <head>

      <meta charset="utf-8">
      <meta name="viewport" content="initial-scale=1.0">
      <title>catalogue</title>
      <link href="http://fonts.googleapis.com/css?family=Montserrat:400,400,700|Ubuntu:400" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="css/standardize.css">
      <link rel="stylesheet" href="css/catalogue-grid.css">
      <link rel="stylesheet" href="css/catalogue.css">

    <?php
      $pseudo = NULL;
      if (isset($_SESSION["pseudo"])){
        $pseudo = $_SESSION["pseudo"];
      }
      head($pseudo);
    ?>

      <section class="catalogue catalogue-3 clearfix">
        <div class="recherche"></div>
      </section>

      <p class="recherche recherche-2">Recherche :</p>

      <input class="_input" placeholder="Nom, Ingrédients, coût, difficulté..." type="text">
      <button class="_button">Rechercher</button>

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