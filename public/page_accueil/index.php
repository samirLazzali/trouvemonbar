<?php

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

      <header class="container clearfix">

        <div class="caddie"></div>
        <h1 class="titre">Dans ton caddie !</h1>

        <div onClick="window.location='inscription.html';" class="inscription inscription-1 clearfix">
          <p class="inscription">Inscription</p>
        </div>

        <section onClick="window.location='connexion.html';" class="connexion connexion-1 clearfix">
          <p class="connexion">Connexion</p>
        </section>

        <nav class="menu clearfix">

          <div class="accueil accueil-1 clearfix">
            <p onClick="window.location='index.html';" class="accueil">Accueil</p>
          </div>

          <div onClick="window.location='recette.html';" class="hasard hasard-1 clearfix">
            <div class="hasard">
              <p>Recette au&nbsp;</p>
              <p>hasard</p>
            </div>
          </div>

          <div onClick="window.location='catalogue.html';" class="catalogue catalogue-1 clearfix">
            <p class="catalogue">Catalogue</p>
          </div>

          <div onClick="window.location='profil.html';" class="profil profil-1 clearfix">
            <p class="profil">Mon profil</p>
          </div>

        </nav>

      </header>

      <section class="presentation presentation-1 clearfix">
        <p class="presentation">Ceci est un paragraphe de texte à compléter dès que l'on saura quoi mettre dedans...</p>
      </section>

      <section class="engagement clearfix">

        <h2 class="accroche">Voici encore une zone de texte pour donner nos engagements pour atteindre le CAC 40 !</h2>

        <div class="container1 clearfix">
          <h3 class="qualite">Qualité</h3>
          <p class="text1">Bla bla bla pipo pipo</p>
        </div>

        <div class="container2 clearfix">
          <h3 class="technologie">Technologie</h3>
          <p class="text2">Bla bla bla pipo pipo</p>
        </div>

        <div class="container3 clearfix">
          <h3 class="service">Service</h3>
          <p class="text3">Bla bla bla pipo pipo</p>
        </div>

      </section>

      <section class="nouveau nouveau-1 clearfix">

        <h2 class="nouveau">Nouveauté</h2>

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
          <p>1, square de la résistance</p>
          <p>91000 Evry</p>
        </div>

      </footer>

    </body>

  </html>