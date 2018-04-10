<?php

require_once("../../config.php");
require_once("SearchHelper.php");

if (isset($_GET['term']))
    $term = $_GET['term'];
else
    error_die("Missing GET parameter 'term'.");

$results = Search::User($term);
success_die($results);