<?php 
require '../vendor/autoload.php';
//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$GLOBALS['dbName']=$dbName;
$GLOBALS['dbUser']=$dbUser;
$GLOBALS['dbPassword']=$dbPassword;
$GLOBALS['connection']=$connection;

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();

function get_candidats(){
    $req='SELECT * FROM candidat';
    $res=$GLOBALS['connection']->query($req);
    foreach  ($res as $row) {
        print $row['id_candidat'] . "\t";
        print  $row['prenom_c'] . "\t";
        print $row['pseudo_c'] . "\t";
        print $row['nom_c'] . "\n";
    }
}

get_candidats();

?>