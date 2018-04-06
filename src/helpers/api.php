<?php

function json_die($status)
{
    echo json_encode($status);
    die();
}

function error_die($status)
{
    $status = array("status" => "error", "result" => null, "description" => $status);
    json_die($status);
}

function success_die($result)
{
    $status = array("status" => "success", "result" => $result);
    json_die($status);
}

function getUserFromCookie()
{
    // TODO
}