<?php

session_start();
header('Content-type: text/html; charset=utf-8');
include('../includes/config.php');

include('../includes/functions.php');
actualiser_session();

$titre = 'Ajout de chat';
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
			
			<h1>Formulaire d'ajout de chat</h1>
			<p>Bienvenue sur la page d'ajout de chat.<br/>
			Merci de remplir ces champs pour continuer.</p>
			<form action="champs_add_cat.php" method="post" name="Ajout">
				<fieldset><legend>Renseignements</legend>
				<table>
					<tr>
					<td><label for="name" class="float">Nom : </label></td>
					<td><input type="text" name="name" id="name" size="30" /></td>
					</tr>
					
					<tr>
					<td><label for="purity" class="float">Chat pur sang</label></td>
					<td><select name="purity" id="purity" size="1">
						<option value=true,name="purity">Oui</option>
						<option value=false,name="purity">Non</option>
						</select></td></td>
					</tr>
					
					<tr>
					<td><label for="pattern" class="float">Robe (Motifs) : </label></td>
					<td><select name="pattern" id="pattern" size="1">
						<option value="Solide",name="size">Solide</option>
						<option value="Colourpoint",name="size">Colourpoint</option>
						<option value="Bicolore",name="size">Bicolore</option>
						<option value="Ecaille de tortue",name="size">Ecaille de tortue</option>
						<option value="Calico",name="size">Calico</option>
						<option value="Mink",name="size">Mink</option>
						<option value="Sepia",name="size">Sepia</option>
						</select></td>
					</tr>
					
					<tr>
					<td><label for="birthdate" class="float">Date de naissance : </label></td>
					<td><input type="date" name="birthdate" id="birthdate" size="30" /></td>
					</tr>
					
					<tr>
					<td><label for="sexe" class="float">Sexe : </label></td>
					<td><select name="sexe" id="sexe" size="1">
						<option value="0",name="sexe">Mâle</option>
						<option value="1",name="sexe">Femelle</option>
						</select></td>
					</tr>
					
					<tr>
					<td><label for="coat" class="float">Longueur de poil : </label></td>
					<td><select name="coat" id="coat" size="1">
						<option value="0",name="coat">Nu</option>
						<option value="1",name="coat">Court</option>
						<option value="3",name="coat">Mi-Long</option>
						<option value="4",name="coat">Long</option>
						</select></td>
					</tr>
					
					<tr>
					<td><label for="size" class="float">Taille : </label></td>
					<td><select name="size" id="size" size="1">
						<option value="0",name="size">Minuscule</option>
						<option value="1",name="size">Petit</option>
						<option value="3",name="size">Moyen</option>
						<option value="4",name="size">Grand</option>
						<option value="5",name="size">Géant</option>
						</select></td>
					</tr>

					<tr>
					<td><label for="weight" class="float">Poids : </label></td>
					<td><input type="integer" name="weight" id="weight" size="30" /></td>
					</tr>
				</table>
					<input type="submit" value="Valider" />
				</fieldset>
			</form>
		</div>

<?php
		include('../includes/bottom.php');
		?>