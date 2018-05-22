<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require "../../../src/app/helpers.php";

//decode file
$data = json_decode(file_get_contents("php://input"));

//insert system
if(Gamesystem::insert($data->name, $data->desc))
{
    echo '{';
    echo '"message": "System was created"';
    echo '}';

}
//if unable to create the system, tell the user
else
{
    echo '{';
    echo '"message": "Unable to create system"';
    echo '}';
}