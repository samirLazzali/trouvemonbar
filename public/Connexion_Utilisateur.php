<?php 


$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


$nom = $_POST['nom'];
$mot_de_passe = $_POST['mot_de_passe'];


$rep = $connection->query("SELECT id_utilisateur, nom_utilisateur, mot_de_passe FROM Utilisateur")->fetchAll();
$a = 0;

foreach ($rep as $data) {

    if($data['nom_utilisateur'] == $nom && $data['mot_de_passe'] == $mot_de_passe)
    {
        session_start();
        $_SESSION['id_utilisateur'] = $data['id_utilisateur'];
        $_SESSION['login'] = $_POST['nom'];
        $_SESSION['pwd'] = $_POST['mot_de_passe'];
        $_SESSION['ok'] =  0;
        $a = 1;
        header ('location: index.php');
        break;
    }


}

if($a == 0) {
    session_start();
    $_SESSION['ok'] = -1;
    header('location: index.php');
}



?>

