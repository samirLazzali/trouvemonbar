<?php

session_start();
  ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0">
  <title>catalogue</title>
  <link href="http://fonts.googleapis.com/css?family=Montserrat:400|Kite+One:400,400" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/standardize.css">
  <link rel="stylesheet" href="css/catalogue-grid.css">
  <link rel="stylesheet" href="css/catalogue.css">
</head>
<body class="body page-catalogue clearfix">
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
  <section class="recette clearfix">

    <div class="recherche recherche-1 clearfix">
      <p class="recherche recherche-2">Recherche :</p>
      <input class="recherche recherche-3" placeholder="nom de recette, ingrédient" type="text">
      <button class="recherche recherche-4">Rechercher</button>
        <?php
        if(isset($_SESSION['membre_id'])) {
            ?>

            <button onClick="window.location='nouvelle_recette.php';" class="nouveau">Proposer une nouvelle recette
            </button>
            <?php
        }
        ?>
      <button onClick="window.location='recette.php';" class="nouveau">Voir les recettes</button>
    </div>

    <div class="liste clearfix">
      <div class="recette1 clearfix">
        <div class="image1"></div>
        <p class="text1">Description de la première recette ...</p>
      </div>
      <div class="recette2 clearfix">
        <div class="image2"></div>
        <p class="text2">Description de la première recette ...</p>
      </div>
      <div class="recette3 clearfix">
        <div class="image3"></div>
        <p class="text3">Description de la première recette ...</p>
      </div>
    </div>
    
    <div class="page"></div>
  </section>
  <footer class="cuisine cuisine-2 clearfix">
    <p class="adresse">1, square de la Résistance</p>
    <p class="code_postal">91000 Evry</p>
  </footer>
</body>
</html>