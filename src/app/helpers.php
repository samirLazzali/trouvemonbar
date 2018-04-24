<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 24/04/18
 * Time: 19:40
 */

//TODO: remplir filter_string
/**
 * @brief remove special chars from the string
 * @param $string
 * @return $string
 */
function filter_string($string)
{
    return $string;
}

/**
 * @param $title
 * @brief Write the header for the page
 */
function write_header($title)
{
    echo " <!DOCTYPE html>
        <html lang=\"fr\">
        <head>
            <meta charset=\"UTF-8\">
            <link rel=\"stylesheet\" href=\"css/bootstrap.min.css\">
            <title> $title  </title>
        </head>
        <body>";
}

/**
 * @brief write the footer for the page
 */
function write_foot()
{
    echo "</body>

<link rel=\"script\" href=\"js/bootstrap.min.js\">

</html>";
}

/**
 * @param $file a view
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
 * @brief autoloader. do not edit. do not call.
 * @param $classname
 * @return bool
 */
function __autoload($classname) {
    $dirs = ['models', 'class'];
    foreach($dirs as $dir) {
        $dir = __DIR__.'/'.$dir;
        if(file_exists($dir.'/'.$classname.'.php')) {
            require $dir.'/'.$classname.'.php';
            break;
        }
    }
    return class_exists($classname);
}



