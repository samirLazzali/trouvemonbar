<?php
/**
 * Created by PhpStorm.
 * User: agammon
 * Date: 5/12/18
 * Time: 5:20 PM
 */
include("model.php");
include("viewControler.php");

$bdd = db_connect();
$rs = $bdd->query('SELECT * FROM '.$_GET['tab'] .' LIMIT 0');
for ($i = 0; $i < $rs->columnCount(); $i++) {
    $col = $rs->getColumnMeta($i);
    $columns[] = $col['name'];
}


foreach ($columns as $col){

    print "$col :";
    input("text",$col,$col);
}

?>