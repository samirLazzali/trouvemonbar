<?php

session_start();
header('Content-type: text/html; charset=utf-8');
include('../includes/config.php');

include('../includes/functions.php');
actualiser_session();

$titre = 'Ajout de chat';
include('../includes/top.php');
?>
		
		<div id="contenu">
			<h1>Formulaire de mise en place des recherches</h1>
			<p>Bienvenue sur la page d'ajout de recherches.<br/>
			Merci de remplir ces champs pour continuer.</p>
			<form action="champs_search_cat.php" method="post" name="Search">
				<fieldset><legend>Renseignements</legend>
				<table>
					<tr><td><label for="cats" class="float">Choix du chat : </label></td>
					<td><select name="catss" id="cats" size="1">
					<?php
					$dbName = getenv('DB_NAME');
					$dbUser = getenv('DB_USER');
					$dbPassword = getenv('DB_PASSWORD');
					$connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
					$chats = $connexion->query("SELECT id_cat,name_cat FROM Cats WHERE owner=$_SESSION['id_user']");
					while($chat = $chats -> fetch(PDO::FETCH_OBJ)) {
						?>
						<option value = "<?php echo $chat->id_cat; ?>" ,id="breed"><?php echo $chat->name_cat; ?></option>
					<?php } ?>
					</select></td></td>
					</tr>
					
					<tr>
					<td><label for="agemin" class="float">Age minimal recherché (en année) : </label></td>
					<td><input type="integer" name="agemin" id="agemin" size="30" /></td>
					</tr>
					
					<tr>
					<td><label for="agemax" class="float">Age maximal recherché (en année) : </label></td>
					<td><input type="integer" name="agemax" id="agemax" size="30" /></td>
					</tr>
					
					<tr>
					<td><label for="weightmin" class="float">Poids minimal recherché (en kg) : </label></td>
					<td><input type="integer" name="weightmin" id="weightmin" size="30" /></td>
					</tr>
					
					<tr>
					<td><label for="weightmax" class="float">Poids maximal recherché (en kg) : </label></td>
					<td><input type="integer" name="weightmax" id="weightmax" size="30" /></td>
					</tr>
					
					<tr>
					<td><label for="coatmin" class="float">Longueur de poil minimale : </label></td>
					<td><select name="coatmin" id="coatmin" size="1">
						<option value="0",name="nu">Nu</option>
						<option value="1",name="court">Court</option>
						<option value="2",name="milong">Mi-long</option>
						<option value="3",name="long">Long</option>
						</select></td>
					</tr>
					
					<tr>
					<td><label for="coatmax" class="float">Longueur de poil maximale : </label></td>
					<td><select name="coatmax" id="coatmax" size="1">
						<option value="0",name="nu">Nu</option>
						<option value="1",name="court">Court</option>
						<option value="2",name="milong">Mi-long</option>
						<option value="3",name="long">Long</option>
						</select></td>
					</tr>
					
					<tr>
					<td><label for="sizemin" class="float">Taille minimale : </label></td>
					<td><select name="sizemin" id="sizemin" size="1">
						<option value="0",name="minuscule">Minuscule</option>
						<option value="1",name="petite">Petite</option>
						<option value="2",name="moyenne">Moyenne</option>
						<option value="3",name="grande">Grande</option>
						<option value="4",name="geante">Géante</option>
						</select></td>
					</tr>
					
					<tr>
					<td><label for="sizemax" class="float">Taille maximale : </label></td>
					<td><select name="sizemax" id="sizemax" size="1">
						<option value="0",name="minuscule">Minuscule</option>
						<option value="1",name="petite">Petite</option>
						<option value="2",name="moyenne">Moyenne</option>
						<option value="3",name="grande">Grande</option>
						<option value="4",name="geante">Géante</option>
						</select></td>
					</tr>
					
					<tr>
					<td><label for="colors" class="float">Couleurs recherchées : </label></td>
					<td><select name="colors" id="colors" size="1">
						<option value="1",name="noir">Noir</option>
						<option value="2",name="bleu">Bleu</option>
						<option value="3",name="chocolat">Chocolat</option>
						<option value="4",name="lilas">Lilas</option>
						<option value="5",name="cannelle">Cannelle</option>
						<option value="6",name="fauve">Fauve</option>
						<option value="7",name="roux">Roux</option>
						<option value="8",name="creme">Crème</option>
						<option value="9",name="blanc">Blanc</option>
						<option value="10",name="ambre">Ambre</option>
						<option value="11",name="ambrec">Ambre Claire</option>
						<option value="12",name="abricot">Abricot</option>
						</select></td>
					</tr>
					
					<tr><td><label for="breeds" class="float">Races recherchées : </label></td>
					<td><select name="breeds" id="breeds" size="1">
					<?php
					$dbName = getenv('DB_NAME');
					$dbUser = getenv('DB_USER');
					$dbPassword = getenv('DB_PASSWORD');
					$connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
					$retour = $connexion->query("SELECT id_breed,name_breed FROM breeds ORDER BY name_breed");
					while($race = $retour -> fetch(PDO::FETCH_OBJ)) {
						?>
						<option value = "<?php echo $race->id_breed; ?>" ,id="breed"><?php echo $race->name_breed; ?></option>
					<?php } ?>
					</select></td></td>
					</tr>
					
					<tr>
					<td><label for="pattern" class="float">Robe (Motifs) recherchées : </label></td>
					<td><select name="pattern" id="pattern" size="1">
						<option value="Solide",name="solide">Solide</option>
						<option value="Colourpoint",name="coulourpoint">Colourpoint</option>
						<option value="Bicolore",name="bicolore">Bicolore</option>
						<option value="Ecaille de tortue",name="ecaille">Ecaille de tortue</option>
						<option value="Calico",name="calico">Calico</option>
						<option value="Mink",name="mink">Mink</option>
						<option value="Sepia",name="sepia">Sepia</option>
						</select></td>
					</tr>
					<input type="submit" value="Valider" />
				</table>
				</fieldset>
			</form>
		</div>

<?php
include('../includes/bottom.php');
?>