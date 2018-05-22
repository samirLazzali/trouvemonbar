<?php
include("./includes/header.php");
$p = isset($_GET['vp'])?(int) $_GET['vp']:0;
$m = isset($_GET['vm'])?(int) $_GET['vm']:0;

if($p!=0){
    $db = new PDO('mysql:host=localhost;dbname=golriie', 'root', '');
    $query=$db->prepare('SELECT jaime FROM posts WHERE id=:id');
    $query->bindValue(':id',$p, PDO::PARAM_INT);
    $query->execute();
    $data = $query->fetch();
    $j = $data["jaime"];
    $query->closeCursor();
    $j++;
    $query=$db->prepare('UPDATE posts SET jaime = :j  WHERE id = :id');
    $query->bindValue(':id',$p, PDO::PARAM_INT);
    $query->bindValue(':j',$j,PDO::PARAM_INT);
    $query->execute();
    $query->CloseCursor();
    echo "Votre vote a bien été pris en compte";
    exit('<p><a href="./index.php">Cliquez ici pour revenir à la page d\'accueil</a></p>');
}

if($m!=0){
    $db = new PDO('mysql:host=localhost;dbname=golriie', 'root', '');
    $query=$db->prepare('SELECT nul FROM posts WHERE id=:id');
    $query->bindValue(':id',$m, PDO::PARAM_INT);
    $query->execute();
    $data = $query->fetch();
    $j = $data["nul"];
    $query->closeCursor();
    $j++;
    $query=$db->prepare('UPDATE posts SET nul = :j  WHERE id = :id');
    $query->bindValue(':id',$m, PDO::PARAM_INT);
    $query->bindValue(':j',$j,PDO::PARAM_INT);
    $query->execute();
    $query->CloseCursor();
    echo "Votre vote a bien été pris en compte";
    exit('<p><a href="./index.php">Cliquez ici pour revenir à la page d\'accueil</a></p>');
}