<?php
/**
 * Created by PhpStorm.
 * User: agammon
 * Date: 5/10/18
 * Time: 11:03 AM
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

function selectlist($nom,$tabliste){

    print '<select id="'.$nom.'">';

    foreach ($tabliste as $tab){
    print "  <option value=\"$tab[1]\"> $tab[1]</option>";
    };
    print "</select>";

}

function input($type,$name,$id){
    print "<input type='$type' name='$name' id='$id' />";
}
function button($type,$name,$id,$text){
    print "<button type=\"$type\" name=\"$name\" id=\"$id\">$text</button>";
}

function tab_show_crub($repAll,$columns)
{

    print'<div id="tab">';
    print'    <table>';
    print'    <thead style="font-weight: bold">';
    foreach ($columns as $col) {
        print "        <td>$col</td>";

    }
    print'    </thead>';

    print '<tr id="addchamp">';
    foreach ($columns as $col){
       print "<td>";
        input("text",$col,$col);
        print "</td>";
    }

    print "<td><button type='button' id='add' onclick='delmod(3,this)'> Ajouter </button> </td>";
    print "</tr>";
    $line = 0;
    foreach ($repAll as $users) {
        print "<tr class ='mod' id='tabl".$line."' onclick=tabclick(tabl".$line.")>";
        for ($i = 0; $i < count($columns); $i++) {
            print"<td class='".$columns[$i]."'>$users[$i]</td>";
        }
        print "<td class='del'>"; print " <button type='button' class='del' onclick='delmod(1,this)'> Supprimer </button>"; print "</td>";
        print"        </tr>";
        $line++;
    }

    print"</table>
</div>";
}

?>