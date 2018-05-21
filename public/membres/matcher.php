<?php

session_start();
header('Content-type: text/html; charset = utf-8');
include('includes/config.php');

include('includes/functions.php');
actualiser_session();

$titre = 'Matcher';

include('includes/top.php'); 

$val1 = 1;
$val2 = 102;
$tab[] = 1;
$tab[] = 3;
#affMenu();
print "<script>
            function affMatch() {
                var x = document.forms[\"choix\"][\"liste\"].value;
                document.getElementById('matcher').innerHTML = \"num\" + tab[x];
            } 
            var tab = <?php json_encode($tab); ?>; 
            <<form name=\"choix\">
                <select name=\"liste\" onchange=\"affMatch()\">
                    <OPTION VALUE=0 >Choisir une option
                    var i;
                    for (i = 0; i<tab.lenght; i++) {
                        <OPTION VALUE=i >\"chat\" + i
                    }
                </select>
                <input type=\"submit\" value=\"Matcher !\">
            </form>
       </scipt>
       <table id='matcher'>";

include('includes/bottom.php');
?>