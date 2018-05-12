<?php
require '../../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


/*
 * Test si on a déjà liké ce tweet
 */
$req = $connection->query('SELECT * FROM "like" WHERE tweet_id = '.$_GET['T_id'].' AND user_id='.$_GET['pseudo_id']);

if ($req->rowCount() == 1){
    echo -1;
}
else{
    $sth = $connection->prepare('INSERT INTO "like"(tweet_id, user_id) VALUES (:tweet_id, :user_id)');
    $sth->bindValue(':tweet_id', $_GET['T_id']);
    $sth->bindValue(':user_id', $_GET['pseudo_id']);
    $sth->execute();
}






?>

