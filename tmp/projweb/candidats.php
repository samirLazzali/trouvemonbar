<?php
session_start();

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$GLOBALS['dbName']=$dbName;
$GLOBALS['dbUser']=$dbUser;
$GLOBALS['dbPassword']=$dbPassword;
$GLOBALS['connection']=$connection;

function generateLinks(){ 
    $req="SELECT prenom_c,pseudo_c,nom_c, FROM candidat WHERE prenom_c=Sujivan";
	$rep=$GLOBALS['connection']->prepare($req);
	$rep->execute();
	$result=$rep->fetch(PDO::FETCH_ASSOC);
    $i=0;
    $length=sizeof($result);
    echo $result['prenom_c'];
}

generateLinks();

?>