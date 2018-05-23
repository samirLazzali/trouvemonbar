<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 20/05/18
 * Time: 18:40
 */
require '../../vendor/autoload.php';
include("Modele.php");
include("Vue.php");
//include ("db.php");
//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");



verif_authent();
entete();
bandeau();

$mdpModif = $_POST["entry1"] ;
$mdp2 = $_POST["entry2"];

if( $mdpModif != $mdp2 )
{
    container();
    container();
    container();
    echo "<h3>Mots de passe différents !</h3>";
    container();
    echo "<a href=Profil.php >Revenir sur ton profil</a>" ;
    container();
    container();

}

else{

    $prep = $connection->prepare("UPDATE users SET mdp = '$mdpModif' WHERE pseudo = :ppp" ) ;
    $prep->execute(array('ppp'=> $_SESSION["uname"]))  ;


    echo "<br/><br/><br/><br/>Mot de passe modifié avec succès<br/><br/><br/><br/>";

}


pied();
?>