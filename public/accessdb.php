<?php
require '../vendor/autoload.php';

function dbConnect(){
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');

    return new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
}

function dbQuery($connection, $query){
    return $connection->query($query)->fetchAll(\PDO::FETCH_OBJ);
}

function dbExec($connection, $query){
    return $connection->query($query);
}

function db_transaction($db,$query_array){
    pg_query($db,"BEGIN");
    $res=1;
    foreach ($query_array as $req) {
	$res *= pg_query($db,$req);
    }
    if($res==0){
	pg_query($db,"ROLLBACK");
    }
    else{
	pg_query( $db , "COMMIT"  );
    }
}

function db_fetch($rep){
    return pg_fetch_assoc( $rep );
}


function db_count($rep){
    return pg_num_rows( $rep );
}


function db_close($db){
    return pg_close( $db );
}

//     _         _                 
//    / \  _   _| |_ _ __ ___  ___ 
//   / _ \| | | | __| '__/ _ \/ __|
//  / ___ \ |_| | |_| | |  __/\__ \
// /_/   \_\__,_|\__|_|  \___||___/

function lookUp($email, $md5Pass) {
    $connection = dbConnect();

    $rows = dbQuery($connection, "SELECT * FROM users WHERE email='$email' AND password='$md5Pass'");

    foreach ($rows as $entry) {
	return $entry->id;
    }

    return -1;
}

?>
