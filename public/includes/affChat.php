<?php

function affTaille($taille){
    /*  if (is_null($taille)) return '_';*/
    if ($taille==0) return 'Miniscule';
    if ($taille==1) return 'Petite';
    if ($taille==2) return 'Moyenne';
    if ($taille==3) return 'Grande';
    if ($taille==4) return 'Géante';
    if ($taille==5) return 'Ur Momma';
    return 'wtf ?!';
}

function affSexe($sexe){
    /*    if (is_null($sexe)) return '_';*/
    if ($sexe==0) return 'male';
    if ($sexe==1) return 'femelle';
    if ($sexe==2) return 'hélicoptère Appach';
    return 'Au secours !';
}

function affBool($b){
    /*   if (is_null($b)) return '_';*/
    if ($b) return 'oui';
    return 'non';
}

function affCoat($c){
/*    if (is_null($c)) return '_'; */
    if ($c==0) return "Nu";
    if ($c==1) return "Court";
    if ($c==2) return "Mi-long";
    if ($c==3) return "Long";
    return "Incroyable";
}

function affChat($id_the_cat) {
    $res ="";

    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    $the_cat = $connexion->query("select *
                                            from Cats
                                            where id_cat=".intval($id_the_cat))->fetch(PDO::FETCH_OBJ);
    $res.='<tr><th>Nom</th><td>'. $the_cat->name_cat .'</td></tr><tr>';
    $res.='<tr><th>Né le</th><td>'. $the_cat->birthday_cat .'</td></tr><tr>';
    $res.='<tr><th>Cherche la pureté</th><td>'. affBool($the_cat->purety) .'</td></tr><tr>';
    $res.='<tr><th>Motif</th><td>'. $the_cat->cpattern .'</td></tr><tr>';
    $res.='<tr><th>Genre</th><td>'. affSexe($the_cat->sex) .'</td></tr><tr>';
    $res.='<tr><th>Taille</th><td>'. affTaille($the_cat->csize) .'</td></tr><tr>';
    $res.='<tr><th>Poid</th><td>'. $the_cat->weight .'kg </td></tr><tr>';
    $res.='<tr><th>Pelage</th><td>'. affCoat($the_cat->weight).'</td></tr><tr>';
    $car = $connexion->query("select name_color 
                                        from Colors
                                        Join Cat_colors ON id_color=color
                                        WHERE cat = ".$id_the_cat);
    $i = true;
    while ($cari=$car->fetch(PDO::FETCH_OBJ))
        if ($i) {
            $i = false;
            $res .= '<tr><th>Couleur</th><td>' . affCoat($cari->name_color) . '</td></tr><tr>';
        }
        else
            $res .= '<tr><th></th><td>' . affCoat($cari->name_color) . '</td></tr><tr>';

    $car = $connexion->query("select name_color 
                                        from Colors
                                        Join Cat_colors ON id_color=color
                                        WHERE cat = ".$id_the_cat);
    $i = true;
    while ($cari=$car->fetch(PDO::FETCH_OBJ))
        if ($i) {
            $i = false;
            $res .= '<tr><th>Couleur</th><td>' . affCoat($cari->name_color) . '</td></tr><tr>';
        }

    $res.='<tr><th>Recherche</th><td></td></tr><tr>';
    $res.='<tr><th>Genre</th><td>'. $the_cat->ssex .'</td></tr><tr>';
    $res.='<tr><th>Age</th><td>'. $the_cat->sage_min .' - '. $the_cat->sage_max .'ans </td></tr><tr>';
    $res.='<tr><th>Taille</th><td>'. affTaille($the_cat->scsize_min) .' - '. affTaille($the_cat->scsize_max) .'</td></tr><tr>';
    $res.='<tr><th>Poid</th><td>'. $the_cat->sweight_min .' - '. $the_cat->sweight_max .'kg </td></tr><tr>';
    $res.='<tr><th>Pelage</th><td>'. affCoat($the_cat->scoat_min) .' - '. affCoat($the_cat->scoat_max) .'</td></tr><tr>';






    return $res;
}



?>