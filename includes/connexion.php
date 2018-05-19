<?php
session_start();
$titre="Connexion";
//include("./id.php");
include("./includes/debut.php");
?>

//On verifie si l'utilisateur est déjà connecté
<?php
echo '<h1>Connexion</h1>';
if ($id!=0) erreur(ERR_IS_CO);
?>
//Formulaire d'inscription
<?php
if (!isset($_POST['pseudo'])) //On est dans la page de formulaire
{
    echo ("<form method=\"post\" action=\"./connexion.php\">
	<fieldset>
	<legend>Connexion</legend>
	<p>
	<label for=\"pseudo\">Pseudo :</label><input name=\"pseudo\" type=\"text\" id=\"pseudo\" /><br />
	<label for=\"password\">Mot de Passe :</label><input type=\"password\" name=\"password\" id=\"password\" />
	</p>
	</fieldset>
	<p><input type=\"submit\" value=\"Connexion\" /></p></form>
		<a href=\"../inscription.php\">Pas encore inscrit ?</a>
	 
	</div>
	</body>
	</html>");
}
?>



