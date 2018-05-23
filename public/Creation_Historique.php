<?php

session_start();
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manger pas cher ! Hisorique</title>
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


    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    $rep = $connection->query("SELECT id_produit, id_client, quantite_prise, date_peremption, date_recup FROM Panier ")->fetchAll();


    foreach ($rep as $data) {

        if($data['id_client'] ==  $_SESSION['id_utilisateur']) {
            $id_produit = $data['id_produit'];
            $id_client = $data['id_client'];
            $quantite = $data['quantite_prise'];
            $date = $data['date_peremption'];
            $date_rep = $data['date_recup'];

            $connection->exec("INSERT INTO Historique(id_produit, id_client, quantite_prise, date_peremption, date_recup)
            VALUES ('$id_produit', '$id_client', '$quantite', '$date', '$date_rep')");
        }

    }

    echo 'Votre commande a bien été prise en compte';
    echo '</section>
    </div>

</body>
</html>';
}
else {

    header ('location: Connexion.html');

}

?>