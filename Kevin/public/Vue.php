<?php

//session_start();

$prenom = $_SESSION['prénom'];
$id = $_SESSION['id'];

/* Recupération des users*/
require_once '../vendor/autoload.php';
require_once 'Modele.php';

function enTete($titre, $style)
{
    print "<!DOCTYPE html>\n";
    print "<html>\n";
    print "  <head>\n";
    print "    <meta charset=\"utf-8\" />\n";
    print "    <title>$titre</title>\n";
    print "    <link rel=\"stylesheet\" href=\"$style\"/>\n";
    print "  </head>\n";

    print "  <body>\n";
   // print "    <header><h1>$titre</h1></header>\n";
}

function pied(){
    print "  </body>\n";
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




/* Fonctions d'affichage générales */

function afficheMenu(){
    global $prenom;
    print "<nav id=\"fontmenu\">\n";
    print "<ul id=\"menu\">\n";
    print "    <li>\n";
    print "        <span class=\"nomsite\">Twitiie</span>\n";
    print "    </li>\n";
    print "    <li>\n";
    print "        <a href=\"accueil.php\">Accueil</a>\n";
    print "    </li>\n";
    print "    <li>\n";
    print "        <a href=\"edition.php?pseudo=$prenom\">Mon Profil</a>\n";
    print "    </li>\n";
    print "    <li>\n";
    print "         <a href=\"Msg_Ecrire.php\">Message</a></br>\n";
    print "    </li>\n";
    print "</ul>\n";
    print "</nav>\n";
}




/* Fonctions pour messages */

function affiche_message($message){
    echo 'Message de '.$message->getEmetteur().' à '.
        ($message->getDate())->format('H:i:s').' le '.
        ($message->getDate())->format('Y-m-d').': ';
    echo $message->getContenu();
    print "</br>";
}


function listeDiscussion($listeAmis){
    print "<p class=\"titre\">Vos amis:</p>\n";
    foreach($listeAmis as $F){
        echo '<button s=\''.$F['id'].'\' onclick="document.getElementById(\'h1\').innerHTML=\'Ma conversation avec '.$F['prénom'].'\'; document.getElementById(\'envoyer\').value='.$F['id'].'; Conversation()">'.$F['prénom'].'</button>';
        print("\n");
    }
}

function afficheListeAmis($listeAmis){
    print "<div class=\"amis\">Vos amis:<br/>\n";
    foreach($listeAmis as $F){
        echo "<a href=\"profil.php?pseudo=".$F['prénom']."&id=".$F['id']."\">@".$F['prénom']."</a><br/>\n";
    }
    print "</div>\n";
}













