<?php
include_once('../modele/DataUser.class.php');
include_once('../controleur/secure.php');
include_once('controleur/checkStatut.php');
include_once('modele/Questionnaire.class.php');
include_once('../utilisateur/modele/Rquestionnaire.class.php');

$code = '';

$error = [
	"valid_quest" => '<span class="ok">Question ajoutée</span>',
	"invalid_quest" => '<span class="error">Question non ajoutée</span>'
];
	
$new_q = new Questionnaire($bdd, $_SESSION['id']);

if (isset($_POST['quest']) && isset($_POST['reponses'])) {
	$quest = secureData($_POST['quest']);
	$rep = serialize($_POST['reponses']);
	
	if (strlen($quest <= 255) && !(empty($rep))) {
		if ($new_q->newQuestion($quest, $rep))
			$code = "valid_quest";
		else
			$code = "invalid_quest";
	}else
		$code = "invalid_quest";
}

if (isset($_GET['supp'])) {
	$supp = (int) secureData($_GET['supp']);
	$new_q->deleteQuestion($supp);
	Rquestionnaire::deleteReponseById($bdd, $supp);
}

$all_questions = Questionnaire::getAllQuestions($bdd)->fetchAll();



include_once("vue/quest.php");

?>