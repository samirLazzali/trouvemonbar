<?php
include "vue.php";
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

      <?php
      $pseudo = NULL;
      if (isset($_SESSION["pseudo"])){
        $pseudo = $_SESSION["pseudo"];
      }
      head($pseudo);
      ?>

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