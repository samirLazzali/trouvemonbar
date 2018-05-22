<?php
session_start();
/**
 * Created by PhpStorm.
 * User: agammon
 * Date: 5/12/18
 * Time: 11:32 PM
 */

include "model.php";

if (!isset($_SESSION['pseudo']) || $_SESSION['id_groupe'] != 2){
    header('Location: index.php'); 
}

$bdd=db_connect();

if ($_GET['mod']==1){//supression
    $bdd->query("DELETE FROM " . $_GET['tab'] ." WHERE id = ". $_GET['id']);
    print "DELETE FROM " . $_GET['tab'] ." WHERE id = ". $_GET['id'];
}
elseif ($_GET['mod']==2){//modification
    $req="";
    foreach ($_GET as $key => $value){
        if ($key != "tab" and $key != "id" and $key != "mod" and $value != ""){
            if ($req == ""){
                $req = " SET " . $key . " = " . $bdd->quote($value) . " ";
            }
            else $req .= " , " . $key . " = " . $bdd->quote($value) . " ";
        }
    }
 $bdd->query("UPDATE " . $_GET['tab'] .$req ." WHERE id = ". $_GET['id']);

}
elseif ($_GET['mod']==3) {
    $req = "";
    foreach ($_GET as $key => $value) {
        if ($key != "tab" and $key != "id" and $key != "mod" and $value != "") {
            if ($req == "") {
                $req = " VALUES ( DEFAULT, " . $bdd->quote($value) ;
            } else $req .= "," . $bdd->quote($value) . " ";
        }
    }
    print "INSERT INTO " . $_GET['tab'] . $req .")";
    $bdd->query("INSERT INTO " . $_GET['tab'] . $req .")");
}

?>