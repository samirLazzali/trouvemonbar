<?php

session_start();
header('Content-type: text/html; charset=utf-8');
include('../includes/config.php');

include('../includes/functions.php');
actualiser_session();

if(isset($_SESSION['id_user']))
{
	header('Location: '.ROOTPATH.'/index.php');
	exit();
}

$titre = 'Inscription';
include('../includes/top.php');
?>

		<div id="contenu">
			
			<h1>Formulaire d'inscription</h1>
			<p>Bienvenue sur la page d'inscription.<br/>
			Merci de remplir ces champs pour continuer.</p>
			<form action="champs_inscription.php" method="post" name="Inscription">
				<fieldset><legend>Renseignements</legend>
				<table>
					<tr>
					<td><label for="pseudo" class="float">Nom d'utilisateur :</label></td>
					<td><input type="text" name="login" id="login" size="30" /></td>
					<td><em> (compris entre 3 et 32 caractères)</em></td>
					</tr>
					<tr>
					<td><label for="mdp" class="float">Mot de passe :</label></td>
					<td><input type="password" name="password" id="password" size="30" /></td>
					<td><em>(compris entre 4 et 50 caractères, avec au moins un chiffre et une majuscule)</em></td>
					</tr>
					<tr>
					<td><label for="mdp_verif" class="float">Mot de passe (vérification) :</label></td>
					<td><input type="password" name="password_verif" id="password_verif" size="30" /></td>
					<td></td>
					</tr>
					<tr>
					<td><label for="mail" class="float">Mail :</label></td>
					<td><input type="text" name="mail" id="mail" size="30" /></td>
					<td></td>
					</tr>
					<tr>
					<td><label for="mail_verif" class="float">Mail (vérification) :</label></td>
					<td><input type="text" name="mail_verif" id="mail_verif" size="30" /></td>
					<td></td>
					</tr>
					<tr>
					<td><label for="phone_number" class="float">Numéro de téléphone :</label></td>
					<td><input type="integer" name="phone_number" id="phone_number" size="30" /></td>
					<td></td>
					</tr>
				</table>
					<input type="submit" value="Valider" />
				</fieldset>
			</form>
		</div>

<?php
		include('../includes/bottom.php');
		?>