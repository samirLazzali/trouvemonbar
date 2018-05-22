<?php
include_once('modele/DataUser.class.php');
include_once('controleur/secure.php');

$new_user = new DataUser($bdd);

if (!isset($_GET['mail']))
	echo 'undefined';
else {
	$mail = secureData($_GET['mail']);
	echo ($new_user->getIdByMail($mail)->fetch() ? 'exist' : '');
}

