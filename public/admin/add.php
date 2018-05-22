<?php

session_start();
header('Content-type: text/html; charset=utf-8');
include('../includes/config.php');

include('../includes/functions.php');
actualiser_session();

$titre = 'Ajout';
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
			
			<h1>Formulaire d'ajout</h1>
			<p>Bienvenue sur la page d'ajout.</p>
			<form action="champs_add.php" method="post" name="Inscription">
				<fieldset><legend>Renseignements</legend>
				<table>
					<tr>
					<?php $_SESSION['prev_mail']='exemple@mail.fr';
					$_SESSION['prev_pseudo']='Pseudo';
					$_SESSION['prev_mdp']='MDPP';
					$_SESSION['prev_mdpbis']='MDPP';
					$_SESSION['prev_mailbis']='exemple@mail.fr';
					$_SESSION['prev_tel']='0102030405';
					?>
					<td><label for="pseudo" class="float">Nom d'utilisateur :</label></td>

					<?php
					echo '<td><input type="text" name="login" value='.$_SESSION['prev_pseudo']. ' id="login" size="30" /></td>'
					?>



					<td><em> (compris entre 3 et 32 caractères)</em></td>
					</tr>
					<tr>
					<td><label for="mdp" class="float">Mot de passe :</label></td>
					
					<?php
					echo '<td><input type="password" name="password" value='.$_SESSION['prev_mdp']. ' id="password" size="30" /></td>'
					?>

					<td><em>(compris entre 4 et 50 caractères, avec au moins un chiffre et une majuscule)</em></td>
					</tr>
					<tr>
					<td><label for="mdp_verif" class="float">Mot de passe (vérification) :</label></td>

					<?php
					echo '<td><input type="password" name="password_verif" value='.$_SESSION['prev_mdpbis']. ' id="password_verif" size="30" /></td>'
					?>
					<td></td>
					</tr>
					<tr>
					
					<td><label for="mail" class="float">Mail :</label></td>

					<?php
					echo '<td><input type="text" name="mail" value='.$_SESSION['prev_mail']. ' id="mail" size="30" /></td>'
					?>

					<td></td>
					</tr>
					<tr>
					<td><label for="mail_verif" class="float">Mail (vérification) :</label></td>

					<?php
					echo '<td><input type="text" name="mail_verif" value='.$_SESSION['prev_mailbis']. ' id="mail_verif" size="30" /></td>'
					?>

					<td></td>
					</tr>
					<tr>
					<td><label for="phone_number" class="float">Numéro de téléphone :</label></td>
					
					<?php
					echo '<td><input type="integer" name="phone_number" value='.$_SESSION['prev_tel']. ' id="phone_number" size="30" /></td>'
					?>



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