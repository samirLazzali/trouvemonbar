<?php

session_start();

?>

<!doctype html>
  <html>

    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="initial-scale=1.0">
      <title>modification_profil</title>
      <link href="http://fonts.googleapis.com/css?family=Ubuntu:400,400|Montserrat:400,700" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="css/standardize.css">
      <link rel="stylesheet" href="css/modification_profil-grid.css">
      <link rel="stylesheet" href="css/modification_profil.css">
    </head>

    <body class="body page-modification_profil clearfix">

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

      <section class="profil profil-3 clearfix">

        <p class="text">Message d'erreur si les données rentrées ne sont pas conforme !</p>

        <div class="log clearfix">
          <div class="avatar"></div>
          <p class="pseudo">Pseudo profil</p>
          <p class="mdp">mot de passe :</p>
          <input class="_input _input-1" placeholder="Tapez votre mot de passe" type="text">
          <p class="mail mail-1">Confirmation :</p>
          <input class="_input _input-2" placeholder="Confirmez votre mot de passe" type="text">
          <p class="mail mail-2">e-mail :</p>
          <input class="_input _input-3" placeholder="Nouvel e-mail" type="text">
          <p class="naissance">date de naissance :</p>
          <input class="_input _input-4" placeholder="Nouvelle date de naissance" type="text">
          <p class="plat">Plat préféré :</p>
          <input class="_input _input-5" placeholder="Nouveau plat préféré" type="text">
          <p class="presentation">Petite présentation :</p>
          <input class="_input _input-6" placeholder="Nouvelle présentation" type="text">
          <button onClick="window.location='modification_profil.html';" class="_button">Modifier son profil</button>
        </div>

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