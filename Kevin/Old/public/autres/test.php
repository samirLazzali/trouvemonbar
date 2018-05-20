<?php

function idUser(){
	return 1;
}
function ajoutNomLien($text){
    $T = explode(" ", $text);
   	for ($i=0; $i<count($T); $i++){
        if ('@' == $T[$i][0]){
        	$T[$i] = "<a href=\"profil.php?pseudo=".substr($T[$i],1)."&id=".idUser(substr($T[$i],1))."\">$T[$i]</a>";
        }
    }
    return implode(" ",$T);
}

$res = ajoutNomLien("Je m'appelle @Kevin");
echo json_encode($res). "\n";
?>



