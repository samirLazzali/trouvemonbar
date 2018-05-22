<?php
include_once('../modele/DataUser.class.php');
include_once('modele/Match.class.php');
include_once('../controleur/secure.php');
include_once('controleur/checkStatut.php');

include_once('controleur/header.php');

$get_match = new Match($bdd, $_SESSION['id']);

if (isset($_GET['delete'])) {
  $delete = (int) secureData($_GET['delete']);
  $get_match->updateResultatMatch($delete, (int) false);
}

$list_match = $get_match->getMatch('banni')->fetchAll();

$genres = [
  "H" => 'Homme',
  "F" => 'Femme'
];

/*On met les états non_lus des matchs à l'etat lu*/
$get_match->updateMatchNonLuPostgre('banni');
$get_match->updateMatchNonLuMysql('banni');

include_once("vue/list_match.php");

?>
