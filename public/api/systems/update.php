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

//fetch data for updated
if(!empty($data->desc))
    $system->setSystemdescription($data->desc);
if(!empty($data->name))
    $system->setSystemname($data->name);

//update system
if($system->update())
{
    echo '{';
    echo '"message" : "Update successful"';
    echo '}';
}
else
{
    echo '{';
    echo '"message" : "Update failed"';
    echo '}';
}