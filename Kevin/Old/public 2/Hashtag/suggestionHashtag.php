<?php
/**
 * Created by PhpStorm.
 * User: KevinXu
 * Date: 19/05/2018
 * Time: 16:04
 */
require_once '../../vendor/autoload.php';


//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$sth = $connection->prepare('SELECT * FROM "hashtag" WHERE mot LIKE \''.strtolower($_GET['m']).'%\'');

$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);

$out = "";
while($result) {
    $out .= "#".$result['mot'];


    $result = $sth->fetch(PDO::FETCH_ASSOC);
    if ($result){
        $out .= ";";
    }
}

echo($out);

?>

