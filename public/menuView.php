<?php
/**
 * Created by PhpStorm.
 * User: agammon
 * Date: 5/14/18
 * Time: 4:30 PM
 */
function head2(){
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
    $days=['lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche'];


    print'<div id="tab">';
    $i=0;
    foreach ($days as $day){

      echo  "<div class=\" $day " . $day ."-1 clearfix\">
      <p class=\". $day .\">". strtoupper($day) ."</p>
      <div class=\"dejeuner dejeuner-" . ($i+1) ." clearfix\">
        <p class=\"dejeuner\">Déjeuner</p>
        <p class=\"plat\" id=\"menu" . $i . "\">";
        afficherRecette("menu" . $i,$i,$menu[$i]);
        $i++;
        echo"</p>
      </div>
      <div class=\"diner diner-" . ($i) ." clearfix\">
        <p class=\"diner\">Dîner</p>
        <p class=\"plat\" id=\"menu" . $i . "\">";
        afficherRecette("menu" . $i,$i,$menu[$i]);
        $i++;
        echo "</p>
      </div>
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
    $recette=recette($recetteid);
    print "<a href='recette.php?recette=". $recetteid . "'> ";
    print $recette['nom'];
    print "</a>";
    print '<br/>';
    print "temps: " . $recette['temps']; print "<br />difficulté: " . $recette['difficulte'];
    print'<br/>';
    print '<button class="modif" onclick="modifrecette(\''. $id .'\','. $index .')">Modifier</button>';
}
?>