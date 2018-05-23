<?php
require '../../vendor/autoload.php';
include("Modele.php");
include("Vue.php");


//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$mdp = $_POST['mdp'];
$uname = $_POST['uname'];

$prep = $connection->prepare("SELECT admin from \"users\" WHERE pseudo = :ppp");

if(verif_mdp($mdp,$uname)) {
	$prep->execute(array('ppp'=>$uname)) ;
    $res=$prep->fetch() ;

    $_SESSION["uname"] = $uname ;

    if(  $res["admin"] == true) {

        $_SESSION["admin"] = 1;

    }
    header('Location: Profil.php');
}
else{
        entete();
        bandeau();
        affiche_erreur("Le mot de passe entré est erroné.");
        affiche_info('Veuillez-essayer de nouveau <a href="Connexion.php">ici</a>.');
        pied();
}

?>
