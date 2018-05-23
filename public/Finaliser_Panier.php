<?php

session_start();

if (isset($_SESSION['id_utilisateur'])) {


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


echo '<script>

function Historique(a) {

    //Création dynamique du formulaire
    var form = document.createElement("form");
    form.setAttribute("method", "POST");
    form.setAttribute("action", "./Supprimer_Produit_Panier.php");

    //Ajout des paramètres sous forme de champs cachés
    var champCache1 = document.createElement("input");
    champCache1.setAttribute("type", "hidden");
    champCache1.setAttribute("name", "rang");
    champCache1.setAttribute("value", a);
    form.appendChild(champCache1);

    //Ajout du formulaire à la page et soumission du formulaire
    document.body.appendChild(form);
    form.submit();
}


</script>';


    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    $rep = $connection->query("SELECT id_panier, id_produit, id_client, categorie, types, marque, prix, date_de_peremption, reduction, image, quantite_prise, date_peremption, date_recup FROM Panier NATURAL JOIN Produit")->fetchAll();
    $a = 1;



    echo '<table id="finaliser_panier"><tr><td>Reference</td><td>Image</td><td>Categorie</td><td>Marque</td><td>Prix</td><td>Date de Peremption</td><td>Reduction</td><td>Quantite prise</td><td></td></tr>';
    foreach ($rep as $data) {

        $b = $data['id_panier'];

        if($data['id_client'] ==  $_SESSION['id_utilisateur']) {

            echo '<tr id='.$a.'>';
            echo '<td>'.$data['id_produit'].'</td>';
            echo '<td><img src='.$data['image'].' alt="photo" height=59 width=89 /></td>';
            echo '<td>'.$data['categorie'].'</td>';
            echo '<td>'.$data['marque'].'</td>';
            echo '<td>'.$data['prix'].'</td>';
            echo '<td>'.$data['date_de_peremption'].'</td>';
            echo '<td>'.$data['reduction'].'</td>';
            echo '<td>'.$data['quantite_prise'].'</td>';
            echo '<td><button type=”button” onclick="Historique('.$b.')">Supprimer</button></td>';

            echo '</tr>';

        }

        ++$a;



    }

    echo '</table>';
    echo '</br></br></br>';

    echo '<a href="Creation_Historique.php">Payer</a>';
    echo '</section>
    </div>

</body>
</html>';

}
else {

    header ('location: Connexion.html');

}

?>