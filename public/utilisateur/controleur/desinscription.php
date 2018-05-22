<?php
include_once('../modele/DataUser.class.php');
include_once('../modele/ProfilUser.class.php');
include_once('../controleur/secure.php');
include_once('controleur/checkStatut.php');
include_once('../admin/modele/Questionnaire.class.php');

include_once('controleur/header.php');

$code = '';
$error = [
	"invalid_pass" => '<span class="error">Le mot de passe est invalide</span>',
	"error_delete" => '<span class="error">Problème suppression du compte</span>'
];

/* Désinscription sans questionnaire */
if (isset($_POST['de_sans_quest']) && isset($_POST['pass'])) {
	$user = new DataUser($bdd);

	$pass_check = $user->getPassById($_SESSION['id'])->fetch()['mdp'];
	if ($pass_check == securePassword(secureData($_POST['pass']))) {
		if ($user->deleteUser($_SESSION['id'])) {
			deconnect();
			header('Location: ../');
			exit(1);
		}else
			$code = "error_delete";
	}else
		$code = "invalid_pass";

}

$quest_list = Questionnaire::getAllQuestions($bdd)->fetchAll();

if (isset($_POST['rep']) && isset($_POST['pass'])) {
	if (count($_POST['rep']) == count($quest_list)) {
		$user = new DataUser($bdd);

		$pass_check = $user->getPassById($_SESSION['id'])->fetch()['mdp'];
		if ($pass_check == securePassword(secureData($_POST['pass']))) {
			$valid = true;
			/*On vérifie si les réponses de l'utilisateur correspondent aux réponses porposées*/
			foreach ($_POST['rep'] as $cle => $elt)
				$valid = in_array($elt, unserialize($quest_list[$cle]['reponses']));

			if ($valid) {
				include_once('modele/Rquestionnaire.class.php');

				$rques = new Rquestionnaire($bdd, $_SESSION['id']);
				foreach ($_POST['rep'] as $cle => $elt)
					$rques->insertReponse($_SESSION['mail'], $quest_list[$cle]['id'], secureData($elt));

				if ($user->deleteUser($_SESSION['id'])) {
					deconnect();
					header('Location: ../index.php');
					exit(1);
				}else {
					$rques->deleteAllReponse();
					$code = "error_delete";
				}
			}

		}else
			$code = "invalid_pass";
	}
}






include_once('vue/desinscription.php');
