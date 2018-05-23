<?php

session_start();
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manger pas cher ! Panier</title>
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
if (isset($_SESSION['id_utilisateur'])) {

    $id = $_SESSION['id_utilisateur'];
    if (isset($_POST['oui'])) {

        $dbName = getenv('DB_NAME');
        $dbUser = getenv('DB_USER');
        $dbPassword = getenv('DB_PASSWORD');
        $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

        $rep = $connection->query("DELETE FROM Panier WHERE id_client = '$id'")->fetchAll();


        }

    echo 'Votre Panier a été entièrement supprimé.';
    echo '<br/><br/><br/><br/><br/><br/><a href="index.php">Retour</a>';
    echo '</section>
    </div>

</body>
</html>';
}
else {

    header ('location: Connexion.html');

}

?>