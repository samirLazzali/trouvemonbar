<?php


function age($date_naissance)
{
    $am = explode('/', $date_naissance);
    $an = explode('/', date('d/m/y'));

    if(($am[1] < $an[1]) || (($am[1] == $an[1]) && ($am[0] <= $an[0])))
        return $an[2] - $am[2];

    return $an[2] - $am[2] - 1;
}

function affcompat($id_the_cat) {
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

    $dbname = getenv('db_name'); /* la connexion n'a pas déjà été faite avant ?*/
    $dbuser = getenv('db_user');
    $dbpassword = getenv('db_password');
    $connexion = new pdo("pgsql:host=postgres user=$dbuser dbname=$dbname password=$dbpassword");

    $the_cat = $connexion->query("select *
                                            from cats
                                            where id_cat=".$id_the_cat)->fetch(pdo::fetch_obj);
    $sexch = $the_cat->sex;
    $breedch = query("select breed
                      from cat_breed
                      where cat=".$id_the_cat)->fetch(pdo::fetch_obj)->breed;
    $purerace = $the_cat->purety;

    if($purerace==1)
        $listechats = $connexion->query("select * 
                                          from cats 
                                          join cat_breed on cat=id_cat 
                                          where sexe=" . $sexch . " 
                                            and breed=" . $breedch);
    else
        $listechats = $connexion->query("select * 
                                          from cats 
                                          join cat_breed on cat=id_cat 
                                          where sexe=" . $sexch);
    $chatpot=$listechats->fetch(pdo::fetch_obj);
    while($chatpot){
        $chatspot[] = $chatpot->id_cat;
        $score = 0;
        if (!is_null($the_cat->sage_min) && $the_cat->sage_min <= age($chatpot->birthday_cat))
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
        $score += $prodbreed * $connexion->query("select count(*)
                                                            from cat_breed 
                                                            join searched_breeds on cat_breed.breed = searched_breeds.breed
                                                            where searched_breeds.cat=" . $id_the_cat ."
                                                              and cat_breed.cat=" . $chatpot->id_cat); /*->fetch ?? */
        $score += $prodcolor * $connexion->query("select count(*)
                                                            from cat_color 
                                                            join searched_colors on cat_color.color = searched_colors.color
                                                            where searched_colors.cat=" . $id_the_cat ."
                                                              and cat_color.cat=" . $chatpot->id_cat);
        $score += $prodtraits * $connexion->query("select count(*)
                                                            from cat_trait 
                                                            join searched_traits on cat_trait.trait = searched_traits.trait
                                                            where searched_traits.cat=" . $id_the_cat ."
                                                              and cat_trait.cat=" . $chatpot->id_cat);
        $score += $prodpattern * $connexion->query("select count(*)
                                                            from searched_pattern 
                                                            where cat=" . $id_the_cat .
                                                            "and pattern =" . $chatpot->pattern);
        $scorechatspot[] = $score;
    }
    if (empty($chatspot)) {
        print "<h3> malheureusement, il ne semble qu'aucun chat ne corresponde à vos attentes </h3>";
        print "<p> nous vous invitons à soit attendre que le chat donc vous rêvez la nuit apparaisse sur le site, soit à revoir vos critères de recherche </p>";
    }
    else {
        array_multisort($scorechatspot, $chatspot);
        print "<table>";
        foreach($chatpot as $elu) {
            $infoelu = $connexion->query("select phone_number, name_cat, 
                                                from utilisateurs
                                                natural join cats 
                                                where cat=" . $chatpot)->fetch(pdo::fetch_obj);
            print "<tr> <td>".$infoelu->name_cat."</td><td>".$infoelu->phone_number."</td> </tr>";
        }
        print "</table>";
    }
}

function affmenu(){
    $dbname = getenv('db_name'); /* la connexion n'a pas déjà été faite avant ?*/
    $dbuser = getenv('db_user');
    $dbpassword = getenv('db_password');
    $connexion = new pdo("pgsql:host=postgres user=$dbuser dbname=$dbname password=$dbpassword");
    $chatsPossédés = $connexion->query("SELECT id_cat,cat_name
                                                  FROM cats
                                                  NATURAL JOIN utilisateur
                                                  WHERE id_user=".XXXXX); /* à compléter */
    print "<script>
            <form name="choix">
                <select name=\"liste\" onchange=\"document.getElementById('matchables').value\">'. foreach().'
                </select>
           </form>'
        </script>
    <table style='display:none;' id='matchables'>
    </table>"
}



?>