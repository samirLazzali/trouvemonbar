<?php
if (!defined('__ROOT__')) define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . '/config.php');
require_once(__ROOT__ . '/classes/Trend.php');

$trends = Trend::getTrends();

$tags = array_keys($trends);

foreach ($tags as $tag)
{
    //TODO
    /*insérer du html/JS pour que lorsqu'on clique sur le nom, ça affiche tout les posts concernés dans un la bonne partie de l'écran genre en dessou de la liste des tendances*/
    /*ça pourait être sympa d'afficher les tweets de la #1 tendance dès le départ, !si elle existe!*/
}