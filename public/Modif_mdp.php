<?php

session_start();

if (isset($_SESSION['id_utilisateur'])) {

    $id = $_SESSION['id_utilisateur'];

    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    $rep = $connection->query("SELECT id_utilisateur, mot_de_passe FROM Utilisateur")->fetchAll();

    $mot_de_passe = $_POST['mot_de_passe'];
    $mdpnew1 = $_POST['mot_de_passe_new1'];
    $mdpnew2 = $_POST['mot_de_passe_new2'];

    foreach ($rep as $data) {

        if($data['id_utilisateur'] == $id && $data['mot_de_passe'] == $mot_de_passe)
        {
            if ($mdpnew1 == $mdpnew2) {
                $connection->exec("UPDATE Utilisateur
            SET mot_de_passe = '$mdpnew1' WHERE id_utilisateur = '$id'");
            }

            header ('location: index.php');
            break;
        }


    }


    header('location: index.php');


}
else
{
    header ('location: Connexion.html');

}

?>