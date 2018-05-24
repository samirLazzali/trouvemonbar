<?php
/**
 * Created by PhpStorm.
 * User: mickael
 * Date: 24/04/18
 * Time: 15:48
 */
include("start.php");

function enTete($titre)
{
    print "<!DOCTYPE html>\n";
    print "<html>\n";
    print "  <head>\n";
    print "    <meta charset=\"utf-8\" />\n";
    print "    <title>$titre</title>\n";
    print "    <link rel=\"stylesheet\" href=\"projet.css\"/>\n";
    print "  </head>\n";

    print "  <body>\n";
    print "    <header><h1> $titre </h1></header>\n";
}

function pied(){
    print "</body>";
    print "</html>";

}


function affiche($str) {
    echo $str;
}


function affiche_info($str) {
    echo '<p>'.$str.'</p>';
}

function affiche_erreur($str) {
    echo '<p class="erreur">'.$str.'</p>';
}

function affiche_sortie($titre,$infos,$date,$lieux) {
    print "    <header><h2> $titre </h2></header>\n";
    affiche_info('Le: '.$date);
    affiche_info('A: '.$lieux);
    affiche_info($infos);
}

function aff_sorties(){
    $db=db_connect();
    $req = db_query($db, "SELECT id_sortie, titre, date, nom, s.description FROM \"projet_bda\".\"Sortie\" as s JOIN \"projet_bda\".\"Lieux\" as l ON \"Lieux_localisation\" = localisation;");
    db_fetch($req);
    $count=db_count($req);
    $i=0;
    while ($i<$count)
    {
        $sortie=$req->fetch();
        affiche_sortie($sortie->titre,$sortie->description,$sortie->date,$sortie->nom);
        echo '<form action="inscriptions.php" method="post">'.
            ajout_champ('hidden', $sortie->id_sortie, 'id_sortie', '', 'id_sortie', 1).'<br/>'.
            ajout_champ('submit', 'S\'inscrire', 'soumission', '', '', 0)."\n".
            '</form>';
        if ($_SESSION['droits'] != null && $_SESSION['droits']>=1) {
            echo '<form action="liste_inscrits.php" method="post">' .
                ajout_champ('hidden', $sortie->id_sortie, 'id_sortie', '', 'id_sortie', 1) . '<br/>' .
                ajout_champ('submit', 'Voir la liste des participants', 'liste_part', '', '', 0) . "\n" .
                '</form>';
        }
        $i=$i+1;
    }
    db_close($req);

}

function ajout_champ(){
    /* fonction qui prend comme arguments dans l'ordre: type, value, name, label, id, (required), (step)
        (les arguments entre parenthèses ne sont pas obligatoires, mais doivent être à l'index prévu:
        par exemple, si on veut indiquer un argument step, il faut mettre un argument required)
    */

    $tmp='';
    //label
    if(! empty(func_get_arg(3))){
        $tmp.= '<label for="'.func_get_arg(4) .'">'.func_get_arg(3).':</label>';
    }
    $tmp .= '<input type="'.func_get_arg(0).'" ';
    if(! empty(func_get_arg(4))){
        $tmp.= 'id="'.func_get_arg(4).'" ';
    }
    if(! empty(func_get_arg(1))){
        $tmp.= 'value="'.func_get_arg(1).'" ';
    }
    if(! empty(func_get_arg(2))){
        $tmp.= 'name="'.func_get_arg(2).'" ';
    }
    if(func_num_args()>5 && func_get_arg(5)){
        $tmp.= 'required="required" ';
    }
    if(func_num_args() > 6 && func_get_arg(0) == "number" && func_get_arg(6) == -1){
        $tmp .= 'step="any" ';
    }

    $tmp.='>';
    return $tmp;
}

?>
