<?php
/**
 * Trouve les hashtags les plus postés sur le réseau pour une période donnée.
 * Méthode : GET
 * Paramètres :
 * - timespan : la période (en secondes) sur laquelle chercher les tendances
 * - limit    : le nombre maximal de tendances à renvoyer
 * Renvoie :
 * - status = success, <Dictionnaire de tendances sous la forme { '#hashtag' : nb_de_tweets, ... }>
 */


require_once("../../config.php");
require_once("Trend.php");

if (isset($_GET['timespan']))
    $timespan = $_GET['timespan'];
else
    $timespan = 3600;

if (isset($_GET['limit']))
    $limit = $_GET['limit'];
else
    $limit = 10;

$trends = Trend::getTrends($limit, $timespan);
success_die($trends);