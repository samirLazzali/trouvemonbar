<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" type="text/css" href="css/template.css">
    <link rel="stylesheet" type="text/css" href="css/relo.css">
    <meta charset="UTF-8">
    <title>Page d'acceuil</title>
</head>
<body>
<h1 id="title">
    <a href="index.php"><img class="home" src="img/logo.png" alt="Logo" height ="88" width="94"></a>
    <span id="title1">GolrIIE</span>
    <a href="index.php"><img class="dc" src="img/logo.png" alt="Logo" height ="88" width="94"></a>
</h1>
<img src="img/menu.png" alt="menu">
<ul id="menu">
    <li><a class="active" href="index.php">Home</a></li>
    <li><a href="posts.php">My posts</a></li>
    <li><a href="profile.php">Profile</a></li>
</ul>
<?php
include("includes/inscription.php");
?>
</body>
</html>