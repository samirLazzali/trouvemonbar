<?php
/**
 * Created by PhpStorm.
 * User: KevinXu
 * Date: 16/04/2018
 * Time: 17:45
 */
//include("Message/Message.php");


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
    print "    <header><h1> $titre </h1></header>\n";
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


/* Fonctions pour messages */

function affiche_message($message){
    echo '      <h3>Message de '.$message->getEmetteur().' à '.
    ($message->getDate())->format('H:i:s').' le '.
    ($message->getDate())->format('Y-m-d').'</h6>';
    print "\n";
    echo '          <p>'.$message->getContenu().'</p>';
    print "\n";
}












