<?php

define('TABLE_User', "Users");
define('TABLE_Appreciation', "Appreciation");
define('TABLE_Posts', "Post");

// realpath($_SERVER["DOCUMENT_ROOT"]) . 
define("SITE_ROOT", "/var/www/html/public/src");
define("CLASSES_ROOT", SITE_ROOT . "/classes/");
define("API_ROOT", SITE_ROOT . "/api/");
define("HELPERS_ROOT", SITE_ROOT . "/helpers/");

define("AUTH_COOKIE_NAME", "Vitz_Auth");
define("AUTH_COOKIE_EXP", 24 * 60 * 60);

set_include_path(get_include_path() . ":" . SITE_ROOT . ":" . CLASSES_ROOT . ":" . API_ROOT . ":" . HELPERS_ROOT);

require_once("api.php");

function connect()
{
    $user = "vitz";
    $password = "assassindelapolice";
    $dbname = "vitz";

    $postgres = true;

    if ($postgres)
        $db = $connection = new PDO("pgsql:host=postgres user=$user dbname=$dbname password=$password");
    else
    {
        $user = "root";
        $password = "";
        $db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $password);
    }
    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}
