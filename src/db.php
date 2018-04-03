<?php

function connect()
{
    $user = "ensiie";
    $password = "ensiie";
    $dbname = "Vitz";
    $db = new PDO("pgsql:user=$user dbname=$dbname password=$password");

    return $db;
}