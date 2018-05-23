<?php

//delophontnoah.000webhostapp.com

function db_connect() {
    global $host_name,$user_name,$password,$datb_name;
    return new PDO("mysql:host=$host_name;dbname=$datb_name;charset=utf8", $user_name, $password);
}

function db_query($db,$query) {
    return $db->query($query);
}

function db_prepare($db,$query) {
    return $db->prepare($query);
}

function db_execute($req,$array) {
    $req->execute($array);
    return $req;
}

function db_fetch($req) {
    return $req->fetch();
}

function db_transaction($db,$query_array,$value_array) {

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $db->beginTransaction();

    for($i=0;$i<count($query_array);$i++) {
        $req = $db->prepare($query_array[$i]);
        $req->execute($value_array[$i]);
    }
    $db->commit();
}


function db_count($rep) {
	/*return pg_num_rows( $rep );*/
}


function db_close($db) {
	/*return pg_close( $db );*/
}
