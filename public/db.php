<?php
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$pdo = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");