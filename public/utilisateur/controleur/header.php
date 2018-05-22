<?php

include_once('modele/Match.class.php');
include_once('modele/Chat.class.php');
include_once('../admin/modele/Niveau.class.php');

$match = new Match($bdd, $_SESSION['id']);
$match_cumule = $match->countMatchCumule()->fetch()['nombre_match_cumule'];

$niveau = Niveau::getNiveauCurrent($bdd, $_SESSION['id_sexe'], $match_cumule)->fetch();

$sex_appeal = $niveau['nom'];

$afficher_anim = false;

if (isset($_SESSION['sex-appeal-pallier']) && $niveau['pallier'] > $_SESSION['sex-appeal-pallier'])
  $afficher_anim = true;

$_SESSION['sex-appeal-pallier'] = $niveau['pallier'];

/*Notification de nouveaux matchs*/
$count_match_non_lu = $match->countMatchNonLu()->fetch()['count'];
/*Notification de nouveaux messages*/
$count_message_non_lu = Chat::countMessageNonLu($bdd, $_SESSION['id'])->fetch()['count'];

?>
