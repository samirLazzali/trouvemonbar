<?php
if ($id==0) erreur(ERR_IS_NOT_CO);
?>

<?php
if (empty($_POST['Titre'])) // Si on la variable est vide, on peut considérer qu'on est sur la page de formulaire
{
    echo '<h1>Upload</h1>';
    echo '<form method="post" action="mel.php" enctype="multipart/form-data">
	<fieldset><legend>Infos</legend>
	<label for="titre">* Titre :</label>  <input name="titre" type="text" id="titre" /><br />
	<label for="description">Description </label><textarea name="description" cols="40" rows="5"></textarea><br />
	<label for="avatars">Votre Image : </label><input type="file" name="img" id="img" /><br />
	</fieldset>
	<p><input type="submit" value="Upload" /></p></form>
	</div>
	</body>
	</html>';
}