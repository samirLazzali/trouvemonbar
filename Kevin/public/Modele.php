<?php

//session_start();

$prenom = $_SESSION['prénom'];
$id = $_SESSION['id'];

/* Recupération des users*/
require '../vendor/autoload.php';


//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();

$messageRepository = new \Message\MessageRepository($connection);
$messages = $messageRepository->fetchAll();


/* Fonction pour recuperer le prenom de quelqu'un */
function prenom_user($id_user){
    global $connection;
    $sth = $connection->prepare('SELECT * FROM "user" WHERE id=\''.$id_user.'\';');
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_OBJ);
    return $result->firstname;
}


function get_friendList($id){
    global $connection;
    $sth = $connection->prepare('SELECT * FROM "amis" WHERE personne1=\''.$_SESSION['id'].'\' OR personne2=\''.$_SESSION['id'].'\' ');
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_OBJ);

    $Res = array();
    $i=0;
    while($result){
        $Res[$i] = array();
        if($result->personne1 == $_SESSION['id']){
            $Res[$i]['id'] = $result->personne2;
            $Res[$i]['prénom'] = prenom_user($result->personne2) ;
        }
        else{
            $Res[$i]['id'] = $result->personne1;
            $Res[$i]['prénom'] = prenom_user($result->personne1) ;
        }
        $result = $sth->fetch(PDO::FETCH_OBJ);
        $i++;
    }

    return $Res;
}

/* echo '<pre>';                     POUR AFFICHER ARRAY
    echo '</pre>';*/














