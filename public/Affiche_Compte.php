<?php

session_start();

if (isset($_SESSION['id_utilisateur']) && $_SESSION['pwd']) {

    echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manger pas cher ! Produit</title>
    <link rel="stylesheet" href="style-connexion.css"/>
</head>
<body>';

    echo '<div class = "corps">
<header class = "tete">
    <div class = "logo"><a href="index.php"><img src="../img/logo/logo.png" alt="logo_manger_pas_cher" class="logo"/></a></div>

    <div class = "phrase_accroche"><p class = "phrase_accroche"><a href="index.php" class="phrase_approche">Une autre vision de la consommation </a></p></div>

    <div class = "espace_commercant">
        <div class = "espace_commercants">	
                <a href="index.php" class="espace_commercants"> Retourner à l\'accueil </a>
        </div>
    </div>

</header>';
    echo '<section class="inscription">';


    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


    $rep = $connection->query("SELECT * FROM Utilisateur")->fetchAll();

    foreach ($rep as $data) {

        if ($data['id_utilisateur'] == $_SESSION['id_utilisateur'] && $data['mot_de_passe'] == $_SESSION['pwd']) {

            $pr = $data['prenom_utilisateur'];
            $nan = $data['nom_utilisateur'];
            $adr = $data['adresse'];
            echo 'Bienvenue Monsieur/Madame '.$pr.' '.$nan.' sur le site de Manger pas Cher.';
            echo '<br><br>';
            echo 'Votre adresse est '.$adr.', cette information nous permet de vous envoyer vos colis dans les plus brefs délais.';
            break;
        }


    }
    echo '<br/><br/><br/><br/><br/><a href="index.php">Retour</a>
    </section>
    </div>';

echo '</body>
</html>';
}
else {

    header ('location: Connexion.html');

}


?>
