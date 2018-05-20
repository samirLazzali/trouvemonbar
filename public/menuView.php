<?php
/**
 * Created by PhpStorm.
 * User: agammon
 * Date: 5/14/18
 * Time: 4:30 PM
 */
function head(){
    echo "<!DOCTYPE html>
    <html>
    <head>
    <title>Crub</title>
    <script   src=\"https://code.jquery.com/jquery-3.3.1.js\"
              integrity=\"sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=\"   crossorigin=\"anonymous\"></script>
</head>
<body>";
}

function tab($menu){
    $days=['lundi','mardi','mercredi','jeudi','vendredi','samedi','Dimanche'];


    print'<div id="tab">';
    print'    <table>';
    print'    <thead style="font-weight: bold">';
    print'      <td></td><td>Midi</td><td>Soir</td>';
    print'  </thead>';
    $i=0;
    foreach ($days as $day){

      echo  "<div class=\" $day " . $day ."-1 clearfix\">
      <p class=\". $day .\">". strtoupper($day) ."</p>
      <div class=\"dejeuner dejeuner-1 clearfix\">
        <p class=\"dejeuner\">Déjeuner</p>
        <p class=\"plat\" id=\"menu" . $i . "\">";
        afficherRecette("menu" . $i,$i,$menu[$i]);
        $i++;
        echo"</p>
      </div>
      <div class=\"diner diner-1 clearfix\">
        <p class=\"diner\">Dîner</p>
        <p class=\"plat\" id=\"menu" . $i . "\">";
        afficherRecette("menu" . $i,$i,$menu[$i]);
        $i++;
        echo "</p>
      </div>
    </div>";



       /* print'    <tr>';
        print'      <td>'. $day . '</td><td id=\'menu' . $i . '\'>';
            afficherRecette("menu" . $i,$i,$menu[$i]);
            print'</td>';
            $i++;
            print' <td id=\'menu' . $i . '\'>'; afficherRecette("menu" . $i,$i,$menu[$i]);
            print'</td>';
        $i++;
    */
       }
}


function afficherRecette($id,$index,$recetteid){
    print 'oui '. $id . $recetteid;
    $recette=recette($recetteid);
    print $recette['nom'];
    print '<br/>';
    print '<button id="modif" onclick="modifrecette(\''. $id .'\','. $index .')">Modifier</button>';

}
?>