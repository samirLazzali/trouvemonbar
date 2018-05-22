<?php
include_once('../modele/DataUser.class.php');
include_once('../controleur/secure.php');
include_once('controleur/checkStatut.php');

include_once('controleur/header.php');

$code = '';
$error = [
	"valid_pass" => '<span class="ok">Le mot de passe a été modifié</span>',
	"invalid_pass" => '<span class="error">Le mot de passe est invalide</span>'
];

if (isset($_POST['pass_check']) && isset($_POST['new_pass'])) {
	$pass_check = securePassword(secureData($_POST['pass_check']));
	$new_pass = securePassword(secureData($_POST['new_pass']));

	if (strlen($new_pass) < 6) {
		header('Location: parametres.php');
		exit(1);
	}

	$user = new DataUser($bdd);

	if ($user->updatePass($_SESSION['id'], $pass_check, $new_pass)->rowCount() == 0)
		$code = 'invalid_pass';
	else
		$code = 'valid_pass';


}

include_once('vue/parametres.php');
