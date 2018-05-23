<?php

include("config.php");

function db_connect() {

    global $nom_hote, $nom_base, $nom_user, $mdp;
    return pg_connect("host=$nom_hote user=$nom_user dbname=$nom_base password=$mdp");
}

function db_query($db, $query){

    return pg_query($db, $query);
}

function db_fetch($rep) {

    return pg_fetch_assoc($rep);
}

function db_count($rep) {

    return pg_num_rows($rep);
}

function db_close($db) {

    return pg_close($db);
}

?>