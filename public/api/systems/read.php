<?php

//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require "../../../src/app/helpers.php";


//create an array with all gamesystems and number of gms for it
$systems = Gamesystem::make_list();

//check if list is empty
if(empty($systems)) {
    echo json_encode(
        array("message" => "No systems found. ")
    );
}

//array for our json
$systems_arr = array();
$systems_arr["systems"] = array();

foreach ($systems as $system)
{
    $system_item = array(
        "id" => $system->getGamesystemid(),
        "name" => $system->getSystemname(),
        "desc" => $system->getSystemdescription(),
        "nb_gms" => $system->get_gms_number()
    );
    array_push($systems_arr["systems"], $system_item);

}

echo json_encode($systems_arr);