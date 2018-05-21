<?php

session_start();
header('Content-type: text/html; charset=utf-8');
include('../includes/config.php');
include('../includes/functions.php');

actualiser_session();

$titre = 'Gestion de mon compte';
include('../includes/top.php');
?>

<div id="contenu"><?php
	$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	$dbPassword = getenv('DB_PASSWORD');
	
	$connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
	$result = $connexion -> query("SELECT login, phone_number,mail FROM Utilisateur WHERE id_user = ".intval($_SESSION['id_user']));
	$result -> setFetchMode(PDO::FETCH_OBJ);
	$fetch = $result -> fetch();
	
	global $queries;
	$queries++;?>
	<h1>Profil de <?php echo $fetch->login ;?></h1>
	<p>
	<?php
	
	
	?> Mail : <?php echo $fetch -> mail; ?><br/>
	Numéro de téléphone : <?php echo $fetch -> phone_number; ?></br>
	
	<form name="modif_mdp" id="modif_mdp" method="post" action="champs_compte.php">
				<fieldset><legend>Changer son mot de passe</legend>
					<label for="old" class="float">Ancien mot de passe :</label> <input type="password" name="old" id="old" /><br/>
					<label for="password" class="float">Nouveau mot de passe :</label> <input type="password" name="new" id="new"/><br/>
					<label for="password" class="float">Confirmer mot de passe :</label> <input type="password" name="confirm" id="confirm"/><br/>
					<div class="center"><input type="submit" value="Valider" /></div>
				</fieldset>
	</form>
</div>
<?php
	include('../includes/bottom.php');
?>
	