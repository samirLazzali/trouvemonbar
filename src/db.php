<?php

$TABLE_User = "User";
$TABLE_Appreciation = "Appreciation";
$TABLE_Posts = "Post";

function connect()
{
    $user = "vitz";
    $password = "assassindelapolice";
    $dbname = "Vitz";
    $db = new PDO("pgsql:user=$user dbname=$dbname password=$password");

    return $db;
}