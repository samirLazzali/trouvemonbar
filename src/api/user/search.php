<?php

if (isset($_GET['term']))
    $term = $_GET['term'];
else
{
    $status = array("status" => "error", "description" => "Missing parameter 'term'.");
    echo json_encode($status);
    die();
}

// TODO

?>