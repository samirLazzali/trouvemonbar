<?php
include_once('../modele/DataUser.class.php');
include_once('../controleur/secure.php');
include_once('controleur/checkStatut.php');

$list_statut = ['admin', 'utilisateur', 'banni'];

if (isset($_POST['statut']) && isset($_POST['id_user'])) {
  $statut = (int) secureData($_POST['statut']);
  $id_user = (int) secureData($_POST['id_user']);

  if ($statut < count($list_statut)) {
    $user = new DataUser($bdd);
    $user->updateStatut($id_user, $list_statut[$statut]);
  }
}

$all_user = DataUser::getAll($bdd)->fetchAll();

include_once("vue/list_user.php");

?>
