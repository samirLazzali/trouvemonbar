<?php

session_start();
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 24/04/18
 * Time: 19:40
 */


/**
 * @brief autoloader. do not edit. do not call.
 * @param $classname
 * @return bool
 */
spl_autoload_register(function($classname) {

    $dirs = ['models', 'class'];
    foreach($dirs as $dir) {

        $dir = __DIR__.'/'.$dir;
        error_log($dir);
        if(file_exists($dir.'/'.$classname.'.php')){

            require $dir.'/'.$classname.'.php';
            break;
        }
    }
    return class_exists($classname);
});

/**
 * Class Database
 * Singleton
 * This class lets us initialise and call our PDO with the same call
 */
class Database
{
    protected static $db = null;
    public static function get()
    {
        if (is_null(self::$db)) {
            try {

                $dbName = getenv('DB_NAME');
                $dbUser = getenv('DB_USER');
                $dbPassword = getenv('DB_PASSWORD');
                self::$db = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

                //the driver default fetch mode is now fetch_obj
                //see : http://php.net/manual/fr/pdostatement.fetch.php
                self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            } catch (Exception $e) {
                error(500, 'Error trying to connect to the database : ' . $e->getMessage());
            }
        }

        return self::$db;
    }

}

/**
 * @return PDO the current db
 * alias for Database::get(
 */
function db()
{
 return call_user_func_array(array('Database', 'get'), func_get_args());
}

function error($code = 500, $message = null)
{
    if(is_null($message))
    {
        switch(code) {
            case 500:
                $message = "An internal error occured ! ";
                break;
            case 404:
                $message = "Page was not found";
                break;
            case 403:
                $message = "Access denied";
                break;
            default:
                $message = "An error occured !";
        }
    }
    include "views/_error.php";
    die;
}

/**
 * @brief remove special chars from the string
 * @param $string
 * @return $string
 * @todo : fill this function
 */
function filter_string($string)
{
    return $string;
}


/**
 * @brief redirect to the page passed as parameter
 * @param $file string
 */
function redirect($file) {
    header('Location: '.$file);
    die;
}

/**
 * @param string $file a view
 * @return string path to the view passed in parameters
 */
function view($file) {
    $path = __DIR__.'/views/'.$file;
    if(!file_exists($path)) {
        error(500, "La vue ".$file." n'existe pas.");
    }
    return $path;
}

/**
 * @brief if message is passed as a parameter a temporary message is stored as a session parameter and displayed on the next page.
 * if not, return an array of all temporary messages to be displayed
 * @param null $message string
 * @return array of strings
 */
function flash($message = null) {
    if(!isset($_SESSION['flash']) || !is_array($_SESSION['flash'])) $_SESSION['flash'] = [];
    if(is_null($message)) {
        $messages = $_SESSION['flash'];
        $_SESSION['flash'] = [];
        return $messages;
    }
    $_SESSION['flash'][] = $message;
}




