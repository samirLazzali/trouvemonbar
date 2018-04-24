<?php

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

?>

<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <title> Guiilde </title>
</head>
<body>

<div class="container">
    <h3> Guiilde</h3>
    <h4> Association de jeu de rôle de l'ENSIIE</h4>
</div>
</body>
</html>
