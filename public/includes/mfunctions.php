<?php


function Age($date_naissance)
{
    $am = explode('/', $date_naissance);
    $an = explode('/', date('d/m/Y'));

    if(($am[1] < $an[1]) || (($am[1] == $an[1]) && ($am[0] <= $an[0])))
        return $an[2] - $am[2];

    return $an[2] - $am[2] - 1;
}

function affCompat($id_the_cat) {
    $prodBreed = 5;
    $prodColor = 3;
    $prodTraits = 1;
    $prodSizeMin = 3;
    $prodSizeMax = 5;
    $prodCoatMin = 4;
    $prodCoatMax = 2;
    $prodPattern = 2;
    $prodWeightMin = 4;
    $prodWeightMax = 4;
    $prodAgeMin = 7;
    $prodAgeMax = 4;

    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    $the_cat = $connexion->query("SELECT *
                                            FROM Cats
                                            WHERE id_cat = ".$id_the_cat)->fetch(PDO::FETCH_OBJ);
    $sexCh = $the_cat->sex;
    $breedCh = query("SELECT breed
                      FROM Cat_breed
                      WHERE cat = ".$id_the_cat)->fetch(PDO::FETCH_OBJ)->breed;
    $pureRace = $the_cat->purety;

    if($pureRace==1)
        $listeChats = $connexion->query("SELECT * 
                                          FROM Cats 
                                          JOIN Cat_breed ON cat=id_cat 
                                          WHERE sexe = ".$sexCh." 
                                            AND breed = ".$breedCh);
    else
        $listeChats = $connexion->query("SELECT * 
                                          FROM Cats 
                                          JOIN Cat_breed ON cat = id_cat 
                                          where sexe = ".$sexCh);
    $chatPot=$listeChats->fetch(PDO::FETCH_OBJ);
    while($chatPot){
        $chatsPot[] = $chatPot->id_cat;
        $score = 0;
        if (!is_null($the_cat->sage_min) && $the_cat->sage_min <= Age($chatPot->birthday_cat))
            $score += $prodAgeMin;
        if (!is_null($the_cat->sage_max) && $the_cat->sage_max <= Age($chatPot->birthday_cat))
            $score += $prodAgeMax;
        if (!is_null($the_cat->scsize_min) && $the_cat->scsize_min <= $chatPot->csize)
            $score += $prodSizeMin;
        if (!is_null($the_cat->scsize_max) && $the_cat->scsize_max <= $chatPot->csize)
            $score += $prodSizeMax;
        if (!is_null($the_cat->scoat_min) && $the_cat->scoat_min <= $chatPot->coat)
            $score += $prodCoatMin;
        if (!is_null($the_cat->scoat_max) && $the_cat->scoat_max <= $chatPot->coat)
            $score += $prodCoatMax;
        if (!is_null($the_cat->sweight_min) && $the_cat->sweight_min <= $chatPot->weight)
            $score += $prodWeightMin;
        if (!is_null($the_cat->sweight_max) && $the_cat->sweight_max <= $chatPot->weight)
            $score += $prodWeightMax;
        $score += $prodBreed * $connexion->query("SELECT COUNT(*)
                                                            FROM Cat_breed 
                                                            JOIN Searched_breeds ON Cat_breed.breed = Searched_breeds.breed
                                                            WHERE Searched_breeds.cat = ".$id_the_cat."
                                                              AND Cat_breed.cat=" . $chatPot->id_cat); /*->fetch ?? */
        $score += $prodColor * $connexion->query("SELECT COUNT(*)
                                                            FROM Cat_color 
                                                            JOIN Searched_colors ON Cat_color.color = Searched_colors.color
                                                            WHERE Searched_colors.cat = ".$id_the_cat."
                                                              AND Cat_color.cat = ".$chatPot->id_cat);
        $score += $prodTraits * $connexion->query("SELECT COUNT(*)
                                                            FROM Cat_trait 
                                                            JOIN Searched_traits ON Cat_trait.trait = Searched_traits.trait
                                                            WHERE Searched_traits.cat = ". $id_the_cat ."
                                                              AND Cat_trait.cat= ".$chatPot->id_cat);
        $score += $prodPattern * $connexion->query("SELECT COUNT(*)
                                                            FROM Searched_pattern 
                                                            WHERE cat = ".$id_the_cat ."
															AND pattern = ".$chatPot->pattern);
        $scoreChatsPot[] = $score;
    }
    if (empty($chatsPot)) {
        print "<h3> Malheureusement, il ne semble qu'aucun chat ne corresponde à vos attentes </h3>";
        print "<p> Nous vous invitons à soit attendre que le chat donc vous rêvez la nuit apparaisse sur le site, soit à revoir vos critères de recherche </p>";
    }
    else {
        array_multisort($scoreChatsPot, $chatsPot);
        foreach($chatPot as $elu) {
            $num = $connexion->query("SELECT phone_number
									FROM Utilisateurs 
									WHERE cat = ".$id_the_cat .);
        }

    }
}





?>