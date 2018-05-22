<?php
/**
 * Created by PhpStorm.
 * User: guyonneau
 * Date: 01/05/18
 * Time: 13:29
 */
session_start();

require '../vendor/autoload.php';
include("TPVue.php");

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');

$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$userRepository = new \User\UserRepository($connection);
$user=$userRepository->fetchAll();
if(!($_GET['Identifiant']=="") && !($_GET['Adresse_mail']=="") && !($_GET['Mot_de_passe']=="") && !($_GET['Nom']=="") && !($_GET['Prenom']==""))
{
if(! isset($_GET['action']) ) {
      affiche_erreur("Pas possible d'arriver içi. Bravo!");
}

else {
    if ($_GET['action'] == 'Sinscrire') {
            $userRepository->insert($_GET['Identifiant'], $_GET['Adresse_mail'], $_GET['Mot_de_passe'], $_GET['Nom'], $_GET['Prenom'], $_GET['Date_naissance']);
        //$req=$connection->prepare('INSERT INTO users(pseudo, mail, mdp, date_naissance, nom, prenom) VALUES (?,?,?,?,?,?);');
       // $req->execute(array($_GET['Identifiant'],$_GET['Adresse_mail'],$_GET['Mot_de_passe'],$_GET['Date_naissance'],$_GET['Nom'],$_GET['Prenom']));

        $_SESSION['identifiant']=$_GET['Identifiant'];
        $_SESSION['rang']="0";
    }
    header('Location: main2.php');
    exit();
}
}
else{
    echo'Au moins un des champs est vide';
}

?>

