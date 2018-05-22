<?php

$host = 'localhost';
$dbname = 'meetiie';
$user = 'root';
$pass = '';

try {
	$bdd = new PDO('pgsql:host='.$host.';dbname='.$dbname,$user, $pass);

}catch (Exception $e) {
	die('Erreur: '.$e->getMessage());
}
