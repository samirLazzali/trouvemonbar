<?php
/**
 * Created by PhpStorm.
 * User: agammon
 * Date: 5/12/18
 * Time: 11:32 PM
 */

include "model.php";
$bdd=db_connect();

if ($_GET['mod']==1){
    print $bdd->query("DELETE FROM " . $_GET['tab'] ." WHERE id = ". $_GET['id']);
    print "DELETE FROM " . $_GET['tab'] ." WHERE id = ". $_GET['id'];
}
elseif ($_GET['mod']==2){
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

}

?>