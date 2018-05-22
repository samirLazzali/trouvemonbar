<?php
include("./includes/header.php");
$s = isset($_GET['s'])?(int) $_GET['s']:0;
$db = new PDO('mysql:host=localhost;dbname=golriie', 'root', '');
    $query = $db->prepare('DELETE FROM posts WHERE id=:s');
    $query->bindValue(':s', $s, PDO::PARAM_INT);
    $query->execute();
    $query->closeCursor();
    echo '<p>La suppression a bien été effectuée <a href="./index.php">Cliquez ici pour revenir à la page d\'accueil</a></p>';