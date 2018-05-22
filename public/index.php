<?php
include "vue.php";
session_start();
?>

<!doctype html>
  <html>

    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="initial-scale=1.0">
      <title>index</title>
      <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="css/standardize.css">
      <link rel="stylesheet" href="css/index-grid.css">
      <link rel="stylesheet" href="css/index.css">
    </head>

    <body class="body page-index clearfix">

      <?php
      $pseudo = NULL;
      if (isset($_SESSION["pseudo"])){
        $pseudo = $_SESSION["pseudo"];
      }
      head($pseudo);
      ?>
      <div class="presentation presentation-1">
    <p class="presentation">Dans Ton Caddie ! crée ta liste de courses pour la semaine, correspondant à des menus personnalisés basés sur tes goûts et besoins, accompagnés de leurs recettes !</p>
  </div>
  <section class="engagement clearfix">
    <h2 class="accroche">Dans Ton Caddie ! s'engage ...</h2>
    <div class="container1 clearfix">
      <h3 class="qualite">La Qualité</h3>
      <p class="text1">Nous nous efforçons de nous investir au maximum pour chacun de nos clients, car notre satisfaction passe tout d'abord par la tienne !</p>
    </div>
    <div class="container2 clearfix">
      <h3 class="technologie">La Personnalisation</h3>
      <p class="text"></p>
      <p class="text2">Nous mettons tout en oeuvre pour répondre à tes envies, on s'occupe du caddie et des recettes, mais c'est toi le chef !&nbsp;</p>
    </div>
    <div class="container3 clearfix">
      <h3 class="service">La Confiance</h3>
      <p class="text3">Nous voulons que ton expérience soit la plus sereine possible, et nous remercions nos clients pour la confiance qu'ils nous accordent !</p>
    </div>
  </section>
  <section class="nouveau nouveau-1 clearfix">
    <h2 class="nouveau">Nouveautés</h2>
    <aside class="recette1 recette1-1"></aside>
    <article class="recette1 recette1-2 clearfix">
      <h4 class="titre1">Gâteau gourmand aux fruits rouges</h4>
      <p class="recette1">Voici une délicieuse recette de gâteau aux fruits rouges !</p>
    </article>
    <aside class="recette2 recette2-1"></aside>
    <article class="recette2 recette2-2 clearfix">
      <h4 class="titre2">La Croziflette</h4>
      <p class="recette2">Une recette gourmande et originale !</p>
    </article>
    <aside class="recette3 recette3-1"></aside>
    <article class="recette3 recette3-2 clearfix">
      <h4 class="titre3">Tiramisu</h4>
      <p class="recette3">Le fameux gâteau italien dans vos assiettes !</p>
    </article>
  </section>
  <footer class="contact clearfix">
    <div class="reseau clearfix">
      <div class="facebook"></div>
      <div class="twitter"></div>
      <div class="discord"></div>
    </div>
    <div class="adresse">
      <p>1, square de la Résistance</p>
      <p>91 000 Evry</p>
</div>
  </footer>
</body>
</html>