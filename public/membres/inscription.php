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
		<script> 
		function verifNum(valeur){
			for (var i=0; i<valeur.length; i++){
				var caractere=valeur.substring(i,i+1);
				if (caractere < ”0” || caractere > ”9”) {
					return false; 
				}
			}
			return true;
		}
		</script>
		
		<div id="contenu">
			
			<h1>Formulaire d'inscription</h1>
			<p>Bienvenue sur la page d'inscription.<br/>
			Merci de remplir ces champs pour continuer.</p>
			<form action="champs_inscription.php" method="post" name="Inscription">
				<fieldset><legend>Renseignements</legend>
					<label for="pseudo" class="float">Nom d'utilisateur :&nbsp;        &nbsp;          &nbsp;      &nbsp;     &nbsp;     &nbsp;      &nbsp;     &nbsp;</label> <input type="text" name="login" id="login" size="30" maxlength="32" /><em>&nbsp; (compris entre 3 et 32 caractères)</em><br/>
					<label for="mdp" class="float">Mot de passe :     &nbsp;     &nbsp;      &nbsp;       &nbsp;         &nbsp;          &nbsp;      &nbsp;     &nbsp;     &nbsp;      &nbsp;     &nbsp;</label> <input type="password" name="password" id="password" size="30" maxlength="50"/><em>&nbsp; (compris entre 4 et 50 caractères, avec au moins un chiffre et une majuscule)</em><br/>
					<label for="mdp_verif" class="float">Mot de passe (vérification) :</label> <input type="password" name="password_verif" id="password_verif" size="30" maxlength="50"/><br/>
					<label for="mail" class="float">Mail :&nbsp;          &nbsp;      &nbsp;    &nbsp;        &nbsp;          &nbsp;      &nbsp;     &nbsp;     &nbsp;      &nbsp;     &nbsp;&nbsp;        &nbsp;          &nbsp;      &nbsp;     &nbsp;     &nbsp;      &nbsp;     &nbsp;</label> <input type="text" name="mail" id="mail" size="30" /> <br/>
					<label for="mail_verif" class="float">Mail (vérification) :         &nbsp;      &nbsp;    &nbsp;        &nbsp;          &nbsp;      &nbsp;     &nbsp;</label> <input type="text" name="mail_verif" id="mail_verif" size="30" /><br/>
					<label for="phone_number" class="float">Numéro de téléphone :&nbsp;    &nbsp;     &nbsp;      &nbsp;     &nbsp;</label> <input type="text" name="phone_number" id="phone_number" size="30" maxlength="10" onChange="if (!verifNum(this.value)){alert ('Ne saisissez que des entiers !'); return false}"/><br/>
					<br/>
					<div class="center"><input type="submit" value="Valider" /></div>
				</fieldset>
			</form>
		</div>

<?php
		include('../includes/bottom.php');
		?>