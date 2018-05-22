<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require "../../../src/app/helpers.php";

//get data
$data = json_decode( file_get_contents("php://input"));


//id of the object to be edited
$system_id = $data->id;


//object to be edited
try {
    $system = new Gamesystem($system_id);
}catch (Exception $e)
{
    echo '{';
    echo '"message" : "'.$e->getMessage().'"';
    echo '}';
}

//delete object
if($system->delete()) {
    echo '{';
    echo '"message": "System was deleted"';
    echo '}';
}
else {
    echo '{';
    echo '"message": "System could not be deleted"';
    echo '}';
}

