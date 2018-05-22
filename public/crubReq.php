<?php
session_start();
/**
 * Created by PhpStorm.
 * User: agammon
 * Date: 4/24/18
 * Time: 4:28 PM
 */
include("model.php");
include("viewControler.php");

if (!isset($_SESSION['pseudo']) || $_SESSION['id_groupe'] != 2){
    header('Location: index.php'); 
}



$bdd = db_connect();
$req="";
foreach ($_GET as $key => $value){
    if ($key != "tab" and $value != ""){
        if ($req == ""){
            $req = " WHERE " . $key . " = " . $bdd->quote($value) . " ";
        }
        else $req .= "AND " . $key . " = " . $bdd->quote($value) . " ";
    }
}



$rs = $bdd->query('SELECT * FROM '.$_GET['tab'] .' LIMIT 0');
for ($i = 0; $i < $rs->columnCount(); $i++) {
    $col = $rs->getColumnMeta($i);
    $columns[] = $col['name'];
}



$rep=$bdd->query('SELECT * FROM '. $_GET['tab'] . $req);
if ($rep != false) {
    $repAll = $rep->fetchAll();
    tab_show_crub($repAll, $columns);
    $rep->closeCursor();
}
else  print "<div id='tab'>error sELECT * FROM ". $_GET['tab'] . $req.'</div>';
$rs->closeCursor();

$bdd = null;



?>

