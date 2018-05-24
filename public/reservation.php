<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0">
  <title>reservation</title>
  <link href="http://fonts.googleapis.com/css?family=Montserrat:400|Kite+One:400,400" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/standardize.css">
  <link rel="stylesheet" href="css/reservation-grid.css">
  <link rel="stylesheet" href="css/reservation.css">
</head>
<body class="body page-reservation clearfix">
  <header class="cuisine cuisine-1 clearfix">
    <div class="logo"></div>
    <p class="accroche">L'association des fins gourmets de l'ENSIIE !</p>
    <div onClick="window.location='connexion.html';" class="connexion connexion-1 clearfix">
      <p class="connexion">Connexion</p>
    </div>
    <div onClick="window.location='inscription.html';" class="inscription inscription-1 clearfix">
      <p class="inscription">Inscription</p>
    </div>
    <nav class="navigation clearfix">
      <div onClick="window.location='index.html';" class="accueil accueil-1 clearfix">
        <p class="accueil">Accueil</p>
      </div>
      <div onClick="window.location='menu.html';" class="menu menu-1 clearfix">
        <p class="menu">Menu</p>
      </div>
      <div onClick="window.location='reservation.html';" class="reservation reservation-1 clearfix">
        <p class="reservation reservation-2">Réservation</p>
      </div>
      <div onClick="window.location='catalogue.html';" class="recettes recettes-1 clearfix">
        <p class="recettes">Recettes</p>
      </div>
    </nav>
  </header>
  <section class="reservation reservation-3 clearfix">
    <div class="bandeau clearfix">
      <p class="ligne_gauche">___________________________________________________</p>
      <p class="connexion">Réservation</p>
      <p class="ligne_droite">___________________________________________________</p>
    </div>
    <div class="reservation reservation-4 clearfix">
      <p class="entree entree-1">Entrée :</p>
      <input class="entree entree-2" placeholder="entrée" type="text">
      <p class="plat plat-1">Plat principal :</p>
      <input class="plat plat-2" placeholder="plat principal" type="text">
      <p class="plat plat-3">Dessert :</p>
      <input class="plat plat-4" placeholder="dessert" type="text">
      <p class="plat plat-5">Prix total :</p>
      <button class="_button">Envoyer</button>
    </div>
  </section>
  <footer class="cuisine cuisine-2 clearfix">
    <p class="adresse">1, square de la Résistance</p>
    <p class="code_postal">91000 Evry</p>
  </footer>
</body>
</html>