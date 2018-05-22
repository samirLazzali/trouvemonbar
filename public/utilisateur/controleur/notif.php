<?php
include_once('../modele/DataUser.class.php');
include_once('modele/Match.class.php');
include_once('modele/Chat.class.php');
include_once('../controleur/secure.php');
include_once('controleur/checkStatut.php');

$user = new DataUser($bdd);
$user->updateDernierCo($_SESSION['id']);

$notif = new Match($bdd, $_SESSION['id']);

$notif_count = [];

if (!isset($_SESSION['notif_match']) || empty($_SESSION['notif_match']))
  $_SESSION['notif_match'] = 0;

$notif_count['match'] = $notif->countMatchNonLu()->fetch()['count'];
$notif_count['chat'] = Chat::countMessageNonLu($bdd, $_SESSION['id'])->fetch()['count'];

echo json_encode($notif_count);
