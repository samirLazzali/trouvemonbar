<?php
session_start();
require '../../vendor/autoload.php';
require_once '../Modele.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");



$content = $_POST['textarea']; 

$tweet = ajoutTweet($content);


/* On récupére l'id du tweet qui vient d'être ajouter */
$sth = $connection->prepare('SELECT * FROM "tweet" WHERE auteur=\''.$tweet->getAuteur().'\' ORDER BY date_envoie DESC');
$sth->execute();
$res = $sth->fetch(\PDO::FETCH_ASSOC);

$tweet->setId($res['id']);

ajoutHashtag($tweet);

header("Location: ".$_SERVER['HTTP_REFERER']."");



