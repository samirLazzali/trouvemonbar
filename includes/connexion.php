<input type="hidden" name="page" value="<?php echo $_SERVER['HTTP_REFERER']; ?>" />

<?php
$titre="Connexion";
?>


<?php
//On verifie si l'utilisateur est déjà connecté
echo '<h1>Connexion</h1>';
if ($id!=0) erreur(ERR_IS_CO);
?>

<?php
//Formulaire d'inscription
if (!isset($_POST['pseudo'])) //On est dans la page de formulaire
{
    echo ("<form method=\"post\" action=\"login.php\">
	<fieldset class=cadreinscription>
	<legend class='legende'>Connexion</legend>
	<p>
	<input class=champinscription name=\"pseudo\" type=\"text\" placeholder='pseudo' id=\"pseudo\" /><br /><br/>
	<input class='champinscription' type=\"password\" name=\"password\" placeholder='password' id=\"password\" />
	</p>
	</fieldset><br/>
	<p><input class=connexion type=\"submit\" value=\"Connexion\" /></p></form>
		<p>Pas encore inscrit ? <a href=\"register.php\">rejoignez nous</a><p/>
	 
	</div>
	</body>
	</html>");
}
else{
    $message='';
    if (empty($_POST['pseudo']) || empty($_POST['password']) ) //Oublie d'un champ
    {
        $message = '<p>	Vous devez remplir tous les champs</p> <p>Cliquez <a href="./login.php">ici</a> pour revenir</p>';
    }
    else{
        $query=$db->prepare('SELECT id,pseudo,mdp,rang FROM membres WHERE pseudo=:pseudo');
        $query->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
        $query->execute();
        $data=$query->fetch();
        if(password_verify($_POST['password'],$data["mdp"])){
            $_SESSION['pseudo'] = $data['pseudo'];
            $_SESSION['level'] = $data['rang'];
            $_SESSION['id'] = $data['id'];
            header("Location: index.php");
            //exit();
        }
        else
            {
            $message = '<p>	Le pseudo ou le mot de passe entré est erroné</p> <p>Cliquez <a href="./login.php">ici</a> pour revenir</p>';
        }
        $query->CloseCursor();
    }
    echo $message.'</div></body></html>';
}

?>



