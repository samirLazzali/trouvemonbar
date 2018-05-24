<?php

session_start();

if(isset($_SESSION['membre_id']))
{
    include('../includes/config.php');
    header('Location: '.ROOTPATH.'/index.php');
    exit();
}

?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0">
  <title>inscription</title>
  <link href="http://fonts.googleapis.com/css?family=Montserrat:400|Kite+One:400,400|Bitter:400" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="../css/standardize.css">
  <link rel="stylesheet" href="../css/inscription-grid.css">
  <link rel="stylesheet" href="../css/inscription.css">
</head>
<body class="body page-inscription clearfix">
  <header class="cuisine cuisine-1 clearfix">
    <div class="logo"></div>
    <p class="accroche">L'association des fins gourmets de l'ENSIIE !</p>
    <div onClick="window.location='connexion.php';" class="connexion connexion-1 clearfix">
      <p class="connexion">Connexion</p>
    </div>
    <div onClick="window.location='inscription.php';" class="inscription inscription-1 clearfix">
      <p class="inscription inscription-2">Inscription</p>
    </div>
    <nav class="navigation clearfix">
      <div onClick="window.location='../index.php';" class="accueil accueil-1 clearfix">
        <p class="accueil">Accueil</p>
      </div>
      <div onClick="window.location='../menu.php';" class="menu menu-1 clearfix">
        <p class="menu">Menu</p>
      </div>
      <div onClick="window.location='../reservation.php';" class="reservation reservation-1 clearfix">
        <p class="reservation">Réservation</p>
      </div>
      <div onClick="window.location='../catalogue.php';" class="recettes recettes-1 clearfix">
        <p class="recettes">Recettes</p>
      </div>
    </nav>
  </header>
  <section class="inscription inscription-3 clearfix">
    <div class="bandeau clearfix">
      <p class="ligne_gauche">___________________________________________________</p>
      <p class="inscription">Inscription</p>
      <p class="ligne_droite">___________________________________________________</p>
    </div>
    <p class="erreur">Un champ n'est pas correctement rempli.</p>
    <div class="inscription inscription-5 clearfix">
        <form action="trait-inscription.php" method="post" name="Inscription">
            <p class="pseudo pseudo-1">Pseudo :</p>
            <input class="pseudo pseudo-2" placeholder="pseudo" type="text" name="pseudo" id="pseudo" size="30">
            <p class="mdp mdp-1">Mot de passe :</p>
            <input class="mdp mdp-2" placeholder="mot de passe" type="password" name="mdp" id="mdp" size="30">
            <p class="mdp2 mdp2-1">Confirmation du mot de passe :</p>
            <input class="mdp2 mdp2-2" placeholder="confirmez votre mot de passe" type="password" name="mdp_verif" id="mdp_verif" size="30">
            <p class="email email-1">Adresse mail :</p>
            <input class="email email-2" placeholder="e-mail" type="text" name="mail" id="mail" size="30">
            <p class="email email-1">Confirmation de l'adresse mail :</p>
            <input class="email email-2" placeholder="e-mail" type="text"  name="mail_verif" id="mail_verif" size="30">
            <p class="email email-3">Promo :</p>
            <input class="email email-4" placeholder="promotion" type="text">
            <button class="_button">Inscription</button>
        </form>
    </div>
  </section>
  <footer class="cuisine cuisine-2 clearfix">
    <p class="adresse">1, square de la Résistance</p>
    <p class="code_postal">91000 Evry</p>
  </footer>
</body>
</html>