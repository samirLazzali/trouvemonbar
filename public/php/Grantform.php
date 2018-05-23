<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 21/05/18
 * Time: 22:52
 */
require '../../vendor/autoload.php';
include("Vue.php");
include("Modele.php");

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


$wanted = $_POST['togrant'] ;
$count = count($wanted);

entete();
bandeau();


if( $count > 0) {
    $prep = $connection->prepare("UPDATE users SET admin=TRUE  WHERE pseudo = ? ");
    echo "<br/><br/>Droits accordés à";
    foreach ($wanted as $bidule) {
        if ($prep->execute(array($bidule))) {
            echo "<br/>$bidule<br/>";

        }
    }
    echo "<br/><br/><br/><br/><br/>" ;
}
else{
    echo "<br><br><br>Oui, ne donnez de droits à personne <br><br><br>";
}

pied();
?>