<?php
include_once('../modele/DataUser.class.php');
include_once('../modele/ProfilUser.class.php');
include_once('../controleur/secure.php');
include_once('controleur/checkStatut.php');

include_once('controleur/header.php');
/*
* @brief Afficher un match aléatoire correspondant au critère du genre recherché par l'utilisateur
*/
function afficherMatch($match_new, $search_sexe) {
  if ($search_sexe == 'D')
    echo json_encode($match_new->getNewMatch('banni', 'F', 'H')->fetch());
  else
    echo json_encode($match_new->getNewMatch('banni', $search_sexe, '')->fetch());
}

if (isset($_GET['match'])) {
  $match = secureData($_GET['match']);

  $profil = new ProfilUser($bdd, $_SESSION['id']);

  $search_sexe = $profil->getSexeSearch()->fetch()['search_sexe'];

  $match_new = new Match($bdd, $_SESSION['id']);

  /*Si aucune réponse n'a été envoyé par l'utilisateur*/
  if (empty($match) || (!isset($_GET['result']) || empty($_GET['result'])))
    afficherMatch($match_new, $search_sexe);
  else {
  /*Sinon on enregistre son match*/
    $result = secureData($_GET['result']);
    $match = (int) $match;

    $search_sexe2 = '';
    if ($search_sexe == 'D') {
      $search_sexe = 'F';
      $search_sexe2 = 'H';
    }

    /*On vérifie si le match est valide juste avant l'enregistrement*/

    if ($_SESSION['id'] != $match && !$match_new->issetMatch($match, 'banni', $search_sexe, $search_sexe2)->fetch()) {
      $match_new->setNewMatch($match, (int) ($result == 'o'), (int) false)->fetch();
      if ($match_new->checkMatch($match)->fetch()) {
        Match::updateMatchCumulePlus($bdd, $_SESSION['id']);
        Match::updateMatchCumulePlus($bdd, $match);
      }
    }
	if ($search_sexe2 != '')
    	$search_sexe = 'D';
    afficherMatch($match_new, $search_sexe);
  }
}else
  include_once('vue/match.php');

?>
