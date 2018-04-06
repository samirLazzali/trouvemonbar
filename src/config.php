<?php

define('TABLE_User', "Users");
define('TABLE_Appreciation', "Appreciation");
define('TABLE_Posts', "Post");

define("SITE_ROOT", "C:\\WAMP\\www\\Vitz\\src");
define("CLASSES_ROOT", SITE_ROOT . "/classes/");
define("API_ROOT", SITE_ROOT . "/api/");

function connect()
{
    $user = "vitz";
    $password = "assassindelapolice";
    $dbname = "Vitz";

    $postgres = false;

    if ($postgres)
        $db = new PDO("pgsql:user=$user dbname=$dbname password=$password");
    else
    {
        $user = "root";
        $password = "";
        $db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    return $db;
}