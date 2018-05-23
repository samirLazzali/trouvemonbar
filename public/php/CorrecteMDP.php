<?php
/**
 * Created by PhpStorm.
 * User: shuo_xu
 * Date: 19/05/18
 * Time: 14:59
 */

include("Modele.php");
include("Vue.php");

$mdp1 = $_POST['mdp1'];
$mdp2 = $_POST['mdp2'];
$uname = $_POST['uname'];
$dnais = $_POST['dnais'];
$testdnais = null ;

$connection = db_connect();
$users = db_fetchAll_Users($connection);
foreach ($users as $user){
    if (($testuname=$user->getPseudo()) == $uname) {
        $testdnais = date_format($user->getBirthday(), "Y-m-d");
    }
}


if($testdnais == $dnais) {
    if($mdp1 != $mdp2){
        entete();
        bandeau();
        affiche_erreur("Les deux MDP sont différents.");
        affiche_info('Veuillez-réessayer<a href="Correcter.php">ici</a>.');
        pied();
    }
    else {
        changeMDP($uname,$mdp1);
        entete();
        bandeau();
        affiche_info('Le mot de passe est modifie! <a href="Profil.php">Veuillez continuer!</a>.');
        pied();
        header('Location: Profil.php');
    }
}
else{
    entete();
    bandeau();
    affiche_erreur("Les infos sont erronées.");
    affiche_info('Veuillez-réessayer<a href="Correcter.php">ici</a>.');
    pied();
}