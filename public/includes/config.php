<?php

define('ROOTPATH', 'http://'.$_SERVER['HTTP_HOST'], true);
define('TITRESITE', 'CATisfaction', true);
$queries = 0;

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
?>