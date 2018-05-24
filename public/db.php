<?php
include("config.php");

function db_connect(){
    global $nom_hote, $nom_user, $nom_base, $mdp_db;
    $connexion = new PDO("pgsql:host=$nom_hote user=$nom_user dbname=$nom_base password=$mdp_db");
    return $connexion;
}

function db_query($connexion,$query){
	$res = $connexion->query($query);
	return $res;
}

function db_fetch($rep){
	return ($rep->setFetchMode(PDO::FETCH_OBJ));
}


function db_count($rep){
	return ($rep->rowCount());
}


function db_close($res){
	return ($res->closeCursor());
}


?>
