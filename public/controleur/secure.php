<?php
session_start();

function deconnect() {
	$_SESSION = array();

	session_destroy();
}

/*Fonctions qui vérifient le statut de l'utilisateur*/

/*ATTENTION : importer la classe DataUser*/
function checkStatut($bdd) {
	if (!isset($_SESSION['id']) || empty($_SESSION['id']))
		return "invite";
	else{
		if (isset($_SESSION['statut']) && !empty($_SESSION['statut'])) {
			$user_statut = new DataUser($bdd);

			$_SESSION['statut'] = $user_statut->getStatutById($_SESSION['id']);
			/*Vérifie si l'utilisateur existe encore en base*/
			if (!$_SESSION['statut'])
				return 'invite';
			$_SESSION['statut'] = $_SESSION['statut']->fetch()['statut'];
			if ($_SESSION['statut'] == 'utilisateur' || $_SESSION['statut'] == 'admin')
				return $_SESSION['statut'];
        	else {
            	deconnect();
				return 'error';
            }
		}else {
			deconnect();
			return 'error';
		}
	}
}

/*Fonctions pour éviter les flood*/

/**
* @brief retourne faux si le nombre d'inscription qui s'est réalisé n'a pas dépassé l'écart
* envoyé en paramètre, vrai sinon
* @detail si la fonction renvoie faux, elle met un temps d'attente $attente avant de renvoyer faux
* une nouvelle fois
* @param variable $nb un entier, $ecart et $attente deux entiers qui correspondent à des microsecondes
* @return booléen
*/
function updateInscription($nb, $ecart, $attente) {
	if (!isset($_SESSION['nb_inscription']) && !isset($_SESSION['date_inscription'])) {
		$_SESSION['nb_inscription'] = 0;
		$_SESSION['date_inscription'] = microtime(true);

		return true;
	}
	if ($_SESSION['nb_inscription'] > $nb && (microtime(true) - $_SESSION['date_inscription']) < $ecart) {
		if ((microtime(true) - $_SESSION['date_inscription']) > $attente) {
			$_SESSION['nb_inscription'] = 0;
			$_SESSION['date_inscription'] = microtime(true);
		}

		return false;
	}

	$_SESSION['nb_inscription']++;


	return true;
}


/*Fonctions qui contrôlent les données de l'utilisateur et les sécurisent*/
function secureData($data) { return trim(stripslashes(htmlspecialchars($data))); }

function securePassword($password) {
	$sel = "ecz8C4" * strlen($password);
	$password .= $sel;

	return hash('sha512', $password);
}
