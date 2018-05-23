<?php


$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


$nom = $_POST['nom'];
$mot_de_passe = $_POST['mot_de_passe'];


$rep = $connection->query("SELECT nom_commercant, mot_de_passe, id_centre_commercial FROM Commercant")->fetchAll();
$a = 0;

foreach ($rep as $data)
{

    if($data['nom_commercant'] == $nom && $data['mot_de_passe'] == $mot_de_passe)
    {
        session_start();
        $_SESSION['id_centre_commercant'] = $data['id_centre_commercial'];
        $_SESSION['login_commercant'] = $nom;
        $_SESSION['pwd_commercant'] = $mot_de_passe;
        $_SESSION['ok_commercant'] =  0;
        $a = 1;
        header ('location: espace_commercants.php');
        break;
    }

}

if($a == 0) {
    session_start();
    $_SESSION['ok_commercant'] = -1;
    header('location: espace_commercants.php');
}



?>

