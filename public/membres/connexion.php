<?php
/*
Neoterranos & LkY
Page connexion.php

Permet de se connecter au site.

Quelques indications : (Utiliser l'outil de recherche et rechercher les mentions données)

Liste des fonctions :
--------------------------
Aucune fonction
--------------------------


Liste des informations/erreurs :
--------------------------
Membre qui essaie de se connecter alors qu'il l'est déjà
Vous êtes bien connecté
Erreur de mot de passe
Erreur de pseudo doublon (normalement impossible)
Pseudo inconnu
--------------------------
*/

session_start();
header('Content-type: text/html; charset=utf-8');
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
include('../includes/config.php');


if(isset($_SESSION['membre_id']))
{
    $informations = Array(/*Membre qui essaie de se connecter alors qu'il l'est déjà*/
        true,
        'Vous êtes déjà connecté',
        'Vous êtes déjà connecté avec le pseudo <span class="pseudo">'.htmlspecialchars($_SESSION['membre_pseudo'], ENT_QUOTES).'</span>.',
        ' - <a href="'.ROOTPATH.'/membres/deconnexion.php">Se déconnecter</a>',
        ROOTPATH.'/index.php',
        5
    );

    require_once('../information.php');
    exit();
}
?>
   <!doctype html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1.0">
        <title>connexion</title>
        <link href="http://fonts.googleapis.com/css?family=Montserrat:400|Kite+One:400,400|Bitter:400" rel="stylesheet"
              type="text/css">
        <link rel="stylesheet" href="../css/standardize.css">
        <link rel="stylesheet" href="../css/connexion-grid.css">
        <link rel="stylesheet" href="../css/connexion.css">
    </head>
    <body class="body page-connexion clearfix">
    <header class="cuisine cuisine-1 clearfix">
        <div class="logo"></div>
        <p class="accroche">L'association des fins gourmets de l'ENSIIE !</p>
        <div onClick="window.location='connexion.php';" class="connexion connexion-1 clearfix">
            <p class="connexion connexion-2">Connexion</p>
        </div>
        <div onClick="window.location='inscription.php';" class="inscription inscription-1 clearfix">
            <p class="inscription">Inscription</p>
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
    <?php
if( !isset($_POST['validate']) || $_POST['validate'] != 'ok') {
        ?>
        <section class="connexion connexion-3 clearfix">
            <div class="bandeau clearfix">
                <p class="ligne_gauche">___________________________________________________</p>
                <p class="connexion">Connexion</p>
                <p class="ligne_droite">___________________________________________________</p>
            </div>
            <p class="erreur">Pseudo ou mot de passe incorrect</p>
            <div class="connexion connexion-5 clearfix">
                <form name="connexion" id="connexion" method="post" action="connexion.php">
                    <p class="pseudo pseudo-1">Pseudo :</p>
                    <input class="pseudo pseudo-2" placeholder="pseudo" type="text" name="pseudo" id="pseudo">
                    <p class="mdp mdp-1">Mot de passe :</p>
                    <input class="mdp mdp-2" placeholder="mot de passe" type="password" name="mdp" id="mdp">
                    <input type="hidden" name="validate" id="validate" value="ok"/>
                    <button class="_button">Se Connecter</button>
                </form>
            </div>
        </section>
        <?php
    }


    else
    {

        $res = $connection->prepare('SELECT COUNT(membre_id) AS nbr, membre_id, membre_pseudo, membre_mdp, membre_banni, membre_admin FROM membres WHERE
				membre_pseudo = ? GROUP BY membre_id');
        $res->execute(array($_POST['pseudo']));
        $result=$res->fetch();

        if($result['nbr'] == 1)
        {

            if($_POST['mdp'] == $result['membre_mdp'] && $result['membre_banni']==0)
            {
                $_SESSION['membre_id'] = $result['membre_id'];
                $_SESSION['membre_pseudo'] = $result['membre_pseudo'];
                $_SESSION['membre_mdp'] = $result['membre_mdp'];
                $_SESSION['membre_banni'] = $result['membre_banni'];
                $_SESSION['membre_admin'] = $result['membre_admin'];
                unset($_SESSION['connexion_pseudo']);



                $informations = Array(/*Vous êtes bien connecté*/
                    false,
                    'Connexion réussie',
                    'Vous êtes désormais connecté avec le pseudo <span class="pseudo">'.htmlspecialchars($_SESSION['membre_pseudo'], ENT_QUOTES).'</span>.',
                    '',
                    ROOTPATH.'/index.php',
                    3
                );
                require_once('../information.php');
                exit();
            }

            else
            {
                $_SESSION['connexion_pseudo'] = $_POST['pseudo'];

                if($result['membre_banni']!=0)
                {
                    $informations = Array(/*Membre banni*/
                        true,
                        'Membre banni',
                        'Vous êtes banni.',
                        ' - <a href="'.ROOTPATH.'/index.php">Index</a>',
                        ROOTPATH.'/membres/connexion.php',
                        3
                    );
                }

                else
                {
                    $informations = Array(/*Erreur de mot de passe*/
                        true,
                        'Mauvais mot de passe',
                        'Vous avez fourni un mot de passe incorrect.',
                        ' - <a href="'.ROOTPATH.'/index.php">Index</a>',
                        ROOTPATH.'/membres/connexion.php',
                        3
                    );
                }
                require_once('../information.php');
                exit();
            }
        }

        else if($result['nbr'] > 1)
        {
            $informations = Array(/*Erreur de pseudo doublon (normalement impossible)*/
                true,
                'Doublon',
                'Deux membres ou plus ont le même pseudo, contactez un administrateur pour régler le problème.',
                ' - <a href="'.ROOTPATH.'/index.php">Index</a>',
                ROOTPATH.'/contact.php',
                3
            );
            require_once('../information.php');
            exit();
        }

        else
        {
            $informations = Array(/*Pseudo inconnu*/
                true,
                'Pseudo inconnu',
                'Le pseudo <span class="pseudo">'.htmlspecialchars($_POST['pseudo'], ENT_QUOTES).'</span> n\'existe pas dans notre base de données. Vous avez probablement fait une erreur.',
                ' - <a href="'.ROOTPATH.'/index.php">Index</a>',
                ROOTPATH.'/membres/connexion.php',
                5
            );
            require_once('../information.php');
            exit();
        }
    }
?>

    <footer class="cuisine cuisine-2 clearfix">
        <p class="adresse">1, square de la Résistance</p>
        <p class="code_postal">91000 Evry</p>
    </footer>
    </body>
    </html>
