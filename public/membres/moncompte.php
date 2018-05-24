<?php


session_start();

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
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
    <div onClick="window.location.href='connexion.php';" class="connexion connexion-1 clearfix">
        <p class="connexion">Connexion</p>
    </div>
    <div onClick="window.location.href='inscription.php';" class="inscription inscription-1 clearfix">
        <p class="inscription inscription-2">Inscription</p>
    </div>
    <nav class="navigation clearfix">
        <div onClick="window.location.href='index.php';" class="accueil accueil-1 clearfix">
            <p class="accueil">Accueil</p>
        </div>
        <div onClick="window.location.href='menu.php';" class="menu menu-1 clearfix">
            <p class="menu">Menu</p>
        </div>
        <div onClick="window.location.href='reservation.php';" class="reservation reservation-1 clearfix">
            <p class="reservation">Réservation</p>
        </div>
        <div onClick="window.location.href='catalogue.php';" class="recettes recettes-1 clearfix">
            <p class="recettes">Recettes</p>
        </div>
    </nav>
</header>
<div class="inscription inscription-5 clearfix">
    <?php
    if(!isset($_SESSION['membre_id']))
    {
        ?>

        <p> Vous n'etes pas connectés</p>
        <?php
    }
    else {

        ?>



        <h1>Edition du profil</h1>
        <form action="trait-moncompte.php" method="post" name="Edition">
            <p class="mdp mdp-1">Nouveau mot de passe :</p>
            <input class="mdp mdp-2" placeholder="mot de passe" type="password" name="n_mdp" id="n_mdp" size="30">
            <p class="mdp2 mdp2-1">Confirmation du nouveau mot de passe :</p>
            <input class="mdp2 mdp2-2" placeholder="confirmez votre mot de passe" type="password" name="n_mdp_verif" id="n_mdp_verif" size="30">
            <p class="email email-1">Nouvelle adresse mail :</p>
            <input class="email email-2" placeholder="e-mail" type="text" name="n_mail" id="n_mail" size="30">
            <p class="email email-1">Confirmation de la nouvelle adresse mail :</p>
            <input class="email email-2" placeholder="e-mail" type="text"  name="n_mail_verif" id="n_mail_verif" size="30">
            <button class="_button">Edition</button>
        </form>
        <?php
    }
    ?>
</div>
</body>
</html>