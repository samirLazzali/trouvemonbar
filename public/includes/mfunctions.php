<?php
/* Suiite à une erreur de manipulation, toutes les majuscules du fichier ont été perdues... */

function age($date_naissance)
{
    $am = explode('-', $date_naissance);
    $an = explode('-', date('y-m-d'));

    if(($am[1] < $an[1]) || (($am[1] == $an[1]) && ($am[0] <= $an[0])))
        return $an[2] - $am[2];

    return $an[2] - $am[2] - 1;
}

function affCompat($id_the_cat) {
    $prodbreed = 5;
    $prodcolor = 3;
    $prodtraits = 1;
    $prodsizemin = 3;
    $prodsizemax = 5;
    $prodcoatmin = 4;
    $prodcoatmax = 2;
    $prodpattern = 2;
    $prodweightmin = 4;
    $prodweightmax = 4;
    $prodagemin = 7;
    $prodagemax = 4;

    $res = "";

    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    $the_cat = $connexion->query("select *
                                            from Cats
                                            where id_cat=".intval($id_the_cat))->fetch(PDO::FETCH_OBJ);
    $sexch = $the_cat->ssex;
    $breedch = $connexion->query("select breed
                      from Cat_breed
                      where cat=".intval($id_the_cat))->fetch(PDO::FETCH_OBJ);
    $breed = $breedch->breed;
    $purerace = $the_cat->purety;

    if($purerace==1) {
        $listechats = $connexion->query("select * 
                                          from Cats 
                                          join Cat_breed on Cat_breed.cat=Cats.id_cat 
                                          where sex='$sexch' 
                                          and breed=".intval($breed));
    }
    else {
        $listechats = $connexion->query("select * 
                                          from Cats 
                                          join Cat_breed on Cat_breed.cat=Cats.id_cat 
                                          where sex='$sexch'");
    }
    $chatpot=$listechats->fetch(PDO::FETCH_OBJ);
    while($chatpot){
        $chatspot[] = $chatpot->id_cat;
        $score = 0;
        if (!is_null($the_cat->sage_min) && ($the_cat->sage_min <= age($chatpot->birthday_cat)))
            $score += $prodagemin;
        if (!is_null($the_cat->sage_max) && $the_cat->sage_max <= age($chatpot->birthday_cat))
            $score += $prodagemax;
        if (!is_null($the_cat->scsize_min) && $the_cat->scsize_min <= $chatpot->csize)
            $score += $prodsizemin;
        if (!is_null($the_cat->scsize_max) && $the_cat->scsize_max <= $chatpot->csize)
            $score += $prodsizemax;
        if (!is_null($the_cat->scoat_min) && $the_cat->scoat_min <= $chatpot->coat)
            $score += $prodcoatmin;
        if (!is_null($the_cat->scoat_max) && $the_cat->scoat_max <= $chatpot->coat)
            $score += $prodcoatmax;
        if (!is_null($the_cat->sweight_min) && $the_cat->sweight_min <= $chatpot->weight)
            $score += $prodweightmin;
        if (!is_null($the_cat->sweight_max) && $the_cat->sweight_max <= $chatpot->weight)
            $score += $prodweightmax;
        $score += $prodbreed * $connexion->query("select count(*) AS nbr
                                                            from Cat_breed 
                                                            join Searched_breeds on Cat_breed.breed = Searched_breeds.breed
                                                            where Searched_breeds.cat=" . $id_the_cat ."
                                                              and Cat_breed.cat=" . $chatpot->id_cat)->fetch(PDO::FETCH_OBJ)->nbr; /*->fetch ?? */
        $score += $prodcolor * $connexion->query("select count(*) AS nbr
                                                            from Cat_colors 
                                                            join Searched_colors on Cat_colors.color = Searched_colors.color
                                                            where Searched_colors.cat=" . $id_the_cat ."
                                                              and Cat_colors.cat=" . $chatpot->id_cat)->fetch(PDO::FETCH_OBJ)->nbr;
        $score += $prodtraits * $connexion->query("select count(*) AS nbr
                                                            from Cat_personality 
                                                            join Searched_traits on Cat_personality.trait = Searched_traits.trait
                                                            where Searched_traits.cat=" . $id_the_cat ."
                                                              and Cat_personality.cat=" . $chatpot->id_cat)->fetch(PDO::FETCH_OBJ)->nbr;

        $score += $prodpattern * $connexion->query("select count(*) AS nbr
                                                            from Searched_patterns 
                                                            where cat=" . $id_the_cat .
                                                            "and pattern ='" . $chatpot->cpattern . "'")->fetch(PDO::FETCH_OBJ)->nbr;
        $scorechatspot[] = $score;
        $chatpot=$listechats->fetch(PDO::FETCH_OBJ);
    }
    if (empty($chatspot)) {
        $res = "<h3> malheureusement, il ne semble qu'aucun chat ne corresponde à vos attentes </h3>";
        $res .= "<p> nous vous invitons à soit attendre que le chat donc vous rêvez la nuit apparaisse sur le site, soit à revoir vos critères de recherche </p>";
    }
    else {
        $res ="<tr><th>Nom</th><th>Numéro de téléphone</th></tr>";
        array_multisort($scorechatspot,SORT_DESC, $chatspot);
        $cpt = 0;
        foreach($chatspot as $elu) {
            if($cpt++ ==5)
                break;
            $infoelu = $connexion->query("select phone_number, name_cat
                                                    from Utilisateur
                                                    join Cats ON owner = id_user 
                                                    where id_cat=" . $elu)->fetch(PDO::FETCH_OBJ);
            $res.= '<tr> <td>'.$infoelu->name_cat.'</td><td>'.$infoelu->phone_number.'</td> </tr>';
        }
    }
    return $res;
}


?>