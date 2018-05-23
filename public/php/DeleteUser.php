<?php

require '../../vendor/autoload.php';
include("Vue.php");
include("Modele.php");

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


$wanted = $_POST['todelete'] ;
$count = count($wanted);

entete();
bandeau();

if( $count > 0) {
    $prep = $connection->prepare("DELETE FROM \"users\" WHERE pseudo = ? ");
    echo "<br/><br/>";
    foreach ($wanted as $bidule) {
        if ($prep->execute(array($bidule))) {
            echo "<br/>$bidule : MURDERED<br/>";

        }
    }
    echo "<br/><br/><br/><br/><br/>" ;
}
else{
    echo "<br><br><br>Personne n'a disparu youpi :D<br><br><br>";
}

pied();
?>
