<?php 
require '../../vendor/autoload.php';
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

function print_candidats(){
    $req='SELECT * FROM candidat';
    foreach  ($GLOBALS['connection']->query($req) as $row) {
        print $row['id_candidat'] . "\t";
        print  $row['prenom_c'] . "\t";
        print $row['pseudo_c'] . "\t";
        print $row['nom_c'] . "\n\n";
        echo "<br/>";
    }
}


/**function add_admin(id_admin,prenom_a,nom_a,pseudo_a){

}

function add_epreuve(id_epreuve,nom_e,date_e,id_jury){

}

function add_candidat_epreuve(id){

}*/
?>