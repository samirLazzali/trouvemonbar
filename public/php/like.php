<?php
/**
 * Created by PhpStorm.
 * User: shuo_xu
 * Date: 21/05/18
 * Time: 23:34
 */
include("Vue.php");
include("Modele.php");
entete();
bandeau();
$uname = $_SESSION['uname'];
if(sauvegarde($uname)){
    echo "Cette chapitre est bien enregistre!";
}
else{
    echo "Desole la commande marche pas...";
}
pied();
?>