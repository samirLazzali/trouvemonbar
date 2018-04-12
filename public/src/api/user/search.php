<?php

require_once("../../config.php");
require_once("SearchHelper.php");

if (isset($_GET['term']))
    $term = $_GET['term'];
else
    error_die("Missing GET parameter 'term'.");

if (isset($_GET['limit']))
    $limit = $_GET['limit'];
else
    $limit = 50;

$results = Search::User($term, $limit);
success_die($results);