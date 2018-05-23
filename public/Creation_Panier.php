<?php


session_start();

/*echo $_POST['id_produit'];
echo $_POST['date'];
echo $_SESSION['id_utilisateur'];
echo $_SESSION['quantite'];*/

if (isset($_SESSION['id_utilisateur'])) {

    if (isset($_SESSION['quantite'])) {

        $dbName = getenv('DB_NAME');
        $dbUser = getenv('DB_USER');
        $dbPassword = getenv('DB_PASSWORD');
        $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");



        $id_client = $_SESSION['id_utilisateur'];
        $quantite  = $_SESSION['quantite'];

        $id_produit = $_POST['id_produit'];
        $date = $_POST['date'];
        $date_rep = '2018-05-19';
        $null = $_POST['id_client'];


        /*ON UTILISE query POUR SELECT MAIS exec POUR INSERT DELETE ET UPDATE*/
        $connection->exec("INSERT INTO Panier(id_produit, id_client, quantite_prise, date_peremption, date_recup)
        VALUES ('$id_produit', '$id_client', '$quantite', '$date', '$date_rep')");

        header ('location: Ensemble_de_Produit.php');

//echo '<p>Confirmation ajout panier !</p>';


        /*echo '<a href="index.php">Retour</a>
        </body>
        </html>';*/


    }
    else {

        //echo '<script type="text/javascript" language="javascript">
        //var temp = "Ajoutez une quantité !";
        //alert(temp);
        //</script>';

        header ('location: Ensemble_de_Produit.php');
    }




}
else {

    header ('location: Connexion.html');

}

?>