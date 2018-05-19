<?php

$DB_HOST="localhost";
$DB_NAME="projetWeb";
$DB_USERNAME="root";
$DB_PSW="root";
$DB = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USERNAME, $DB_PSW);
?>