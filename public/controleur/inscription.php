<?php
include_once('modele/DataUser.class.php');
include_once('modele/ProfilUser.class.php');
include_once('utilisateur/modele/Match.class.php');
include_once('controleur/secure.php');
include_once('controleur/checkStatut.php');

/**
* @brief retourne vrai si la date envoyée en paramètre est valide, faux sinon
* @param variable $date sous la forme 'xxxx-xx-xx'
* @return booléen selon le format de la date
*/
function verifDate($date) {
	$date_tab = explode('-', $date);
	$ecart = (new \DateTime())->diff(new \DateTime($date))->format('%y');

	return (count($date_tab) == 3) && (checkdate($date_tab[1], $date_tab[2], $date_tab[0])) && preg_match('#^([0-9]+)-([0-9]+)-([0-9]+)$#', $date) && ($ecart >= 18 && $ecart <= 99);
}
/**
* @brief envoie un mail de validation
* @param variable $mail sous le format d'un e-mail, $code une chaîne de caractère
*/
function envoieCode($mail, $code) {
	$expediteur="no-reply@meetiie.com";
	$header="MIME-Version: 1.0 \n";
	$header="From: \"Meetiie\"<no-reply@meetiie.com> \n";
	$header.="Delivered-to: ".$mail."\n";
	$header.="Content-type: text/html; charset=\"iso-8859-1\"";

	$site="localhost/";

	$message='<a href="'.$site.'inscription.php?mail='.$mail.'&code='.$code.'">Cliquez ici pour valider votre inscription.</a>';
	mail($mail, "Validation - Meetiie", $message, $header);
}

$code = "";
$error = [
	"ok" => '<span class="ok">Votre inscription a bien été prise en compte !<br />Un mail de validation vous a été envoyé</span>',
	"mail_query_error" => '<span class="error">Une erreur est survenue lors de l\'inscription. Veuillez réessayer</span>',
	"mail_exist" => '<span class="error">Le mail existe déja</span>',
	"mail_insert_error" => '<span class="error">Problème insertion</span>',
	"timeout" => '<span class="error">Vous avez fait trop d\'inscriptions. <br />Retentez dans 5 min environ</span>',
	"error_valid_mail" => '<span class="error">Un problème est survenu lors de la validation de votre mail</span>',
	"valid_mail" => '<span class="ok">Votre mail a bien été validé</span>'
];

/*On vérifie l'existence des variables nécessaires pour l'inscription*/
if (isset($_POST['mail']) && isset($_POST['password']) && isset($_POST['search-sexe']) && isset($_POST['id-sexe']) && isset($_POST['date'])) {
	/*On évite le flood*/
	if (!updateInscription(5, 60 * 1000, 5 * 60 * 1000)) {
		$code = "timeout";
	}else {
		/*On sécurise les données reçues*/
		$search_sexe = secureData($_POST['search-sexe']);
		$id_sexe = secureData($_POST['id-sexe']);
		$date = secureData($_POST['date']);

		/*On vérifie le format des données*/
		if (in_array($search_sexe, ['H', 'F', 'D']) && in_array($id_sexe, ['H', 'F']) && verifDate($date)) {
			/*On sécurise les données reçues*/
			$mail = secureData($_POST['mail']);
			$password = secureData($_POST['password']);

			/*On vérifie si le mail est au bon format et le mot de passe ait la taille souhaitée*/
			if (preg_match('#^([a-zA-Z0-9._-]+)@([a-zA-Z0-9._-]+)\.([a-z]{2,8})$#', $mail) && strlen($password) >= 6) {
				$new_user = new DataUser($bdd);
				$id = $new_user->getIdByMail($mail);
				if ($id) {
					/*On vérifie si le mail est unique*/
					if (!$id->fetch()) {
						/*Etape d'enregistrement*/
							try {
								$bdd->beginTransaction();

								$code_validation = sha1(mt_rand());

								$new_user->newUser($mail, securePassword($password), $code_validation);

								$id = $bdd->lastInsertId();

								/*On initialise les paramètres élémentaires de l'utilisateur*/
								ProfilUser::newUser($bdd, $id, $id_sexe, $search_sexe, $date);
								Match::creataNewTsuggestion($bdd, $id);

								$bdd->commit();

								envoieCode($mail, $code_validation);
								$code = "ok";
							}catch(Exception $e) {
								$bdd->rollback();

								/*echo $e->getMessage();*/

								$code = "mail_insert_error";
							}
					}else
						$code = "mail_exist";
				}else
					$code = 'mail_query_error';
			}else {
				header('Location: index.php');
				exit(1);
			}
		}else {
			header('Location: index.php');
			exit(1);
		}
	}
}else if (isset($_GET['mail']) && isset($_GET['code'])) {
	/*On sécurise les données reçues*/
	$mail = secureData($_GET['mail']);
	$code = secureData($_GET['code']);

	/*On évite le flood*/

	/*A améliorer plus tard / on laisse pour le moment*/
	if (!updateInscription(5, 60 * 1000, 5 * 60 * 1000))
		$code = "timeout";
	else {
		$new_user = new DataUser($bdd);

		if ($new_user->validation($mail, $code)->rowCount())
			$code = "valid_mail";
		else
			$code = "error_valid_mail";

	}
}

include_once("vue/inscription.php");
