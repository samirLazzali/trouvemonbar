<div id = "leftcol">
	<h2>Mes infos :</h2>
	<p>
	<?php
	$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	dbPassword = getenv('DB_PASSWORD');
		
	$connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
	$infos = $connexion -> query("SELECT login, phone_number FROM Utilisateur WHERE id_user = ".intval($_SESSION['id_user']));
	$infos -> setFetchMode(PDO::FETCH_OBJ);
	$infos -> fetch();
		
	global $queries;
	$queries++;
		
	echo $infos -> login;
	echo $infos -> phone_number; ?> 
			
			
	<form name="infos_cat" id="infos_cat" actions="/functions.php" method="read_cat">
		<fieldset><legend>Mes chats :</legend>
		<?php
		$chats = $connexion -> query("SELECT id_cat, name_cat FROM Cats WHERE owner = ".intval($_SESSION['id_user']));
		$chats -> setFetchMode(PDO::FETCH_OBJ);
		$chat = $chats -> fetch();
		$i = 1;
		while ($chat != FALSE) { ?>
			<input type ="radio" name="cat" value="<?php $i ?>" id="<?php $i ?>" ><label for "<?php $i ?>"><?php echo $chat->name_cat; ?></label></input><br/>
			<?php $chat = $chats -> fetch();
			$i ++;
		} 
		?>
		<input type="submit" value="Afficher les informations sur le chat en question" />
		</fieldset>
	</form>
	<a href="<?php echo ROOTPATH; ?>/cats/ajouter.php">Ajouter un nouveau chat ++</a>
</div>