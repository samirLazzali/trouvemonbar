<?php

function connect()
{
    $user = "vitz";
    $password = "assassindelapolice";
    $dbname = "Vitz";
    $db = new PDO("pgsql:user=$user dbname=$dbname password=$password");

    return $db;
}