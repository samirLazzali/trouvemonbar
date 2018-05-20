<?php

$prodBreed = 5;
$prodColor = 3;
$prodTraits = 1;
$prodSize = 4;
$prodCoat = 2;
$prodPattern = 2;
$prodWeight = 4;



function affCompat($id_the_cat) {
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    $the_cat = $connexion->query("SELECT *
                                            FROM Cats
                                            WHERE id_cat=".$id_the_cat)->fetch(PDO::FETCH_OBJ);
    $sexCh = $the_cat->sex;
    $breedCh = query("SELECT breed
                      FROM Cat_breed
                      WHERE cat=".$id_the_cat)->fetch(PDO::FETCH_OBJ)->breed;
    $pureRace = $the_cat->purety;

    if($pureRace==1)
        $listeChats = $connexion->query("SELECT * 
                                          FROM Cats 
                                          JOIN Cat_breed ON cat=id_cat 
                                          WHERE sexe=" . $sexCh . " 
                                            AND breed=" . $breedCh);
    else
        $listeChats = $connexion->query("select * 
                                          from cats 
                                          join cat_breed on cat=id_cat 
                                          where sexe=" . $sexCh);
    $chatPot=$listeChats->fetch(PDO::FETCH_OBJ);
    while($chatPot){
        $chatsPot[] = $chatPot->id_cat;
        $scoreChatsPot[] = 0;
        if()
    }



}





?>