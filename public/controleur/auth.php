<?php
include_once('modele/DataUser.class.php');
include_once('modele/ProfilUser.class.php');
include_once('controleur/secure.php');
include_once('controleur/checkStatut.php');

function connect($info_co, $id_sexe, $code) {
	$_SESSION['id'] = $info_co['id'];
	$_SESSION['mail'] = $info_co['mail'];
	$_SESSION['statut'] = $code;
	$_SESSION['id_sexe'] = $id_sexe;
}

$code = "";
$error = [
	"error" => '<span class="error">Vos identifiants sont invalides</span>',
	"valid_mail" => '<span class="error">Il faut valider votre mail avant de pouvoir vous connecter</span>',
	"banni" => '<span class="error">CA DEGAGE</span>'
];

/*On vérifie si l'utilisateur tente de se connecter*/
if (isset($_POST['mail']) && isset($_POST['password'])) {
	/*On sécurise les données reçues*/
	$mail = secureData($_POST['mail']);
	$password = securePassword(secureData($_POST['password']));

	$connect = new DataUser($bdd);

	$info_co = $connect->connectAll($mail, $password)->fetch();

	/*On vérifie si l'utilisateur existe*/
	if ($info_co) {
		$code = $info_co['statut'];

		$profil = new ProfilUser($bdd, $info_co['id']);
		$id_sexe = $profil->getIdSexe()->fetch()['id_sexe'];

		/*On vérifie son statut*/
		if ($code == 'utilisateur') {
			/*Connexion de l'utilisateur*/
			connect($info_co, $id_sexe, $code);

			$connect->updateDernierCo($_SESSION['id']);

			header('Location: utilisateur');
			exit(1);
		}else if($code == 'admin') {
			/*Connexion de l'admin*/
			connect($info_co, $id_sexe, $code);

			$connect->updateDernierCo($_SESSION['id']);

			header('Location: admin');
			exit(1);
		}

	}else
		$code = "error";
}

include_once('vue/auth.php');
