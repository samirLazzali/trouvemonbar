<?php
session_start();
$titre="Inscription";
include("includes/id.php");
include("includes/debut.php");
if ($id!=0) erreur(ERR_IS_CO);
?>

<?php
if (empty($_POST['pseudo'])) // Si on la variable est vide, on peut considérer qu'on est sur la page de formulaire
{
    echo '<h1>Inscription</h1>';
    echo '<form method="post" action="register.php" enctype="multipart/form-data">
	<fieldset><legend>Identifiants</legend>
	<label for="pseudo">* Pseudo :</label>  <input name="pseudo" type="text" id="pseudo" /> (le pseudo doit contenir entre 3 et 15 caractères)<br />
	<label for="password">* Mot de Passe :</label><input type="password" name="password" id="password" /><br />
	<label for="confirm">* Confirmer le mot de passe :</label><input type="password" name="confirm" id="confirm" />
	</fieldset>
	<fieldset><legend>Contacts</legend>
	<label for="email">* Votre adresse Mail :</label><input type="text" name="email" id="email" /><br />
	</fieldset>
	<fieldset><legend>Profil sur le forum</legend>
	<label for="avatars">Choisissez votre avatars : </label><input type="file" name="avatars" id="avatars" />(Taille max : 10Ko)<br />
	</fieldset>
	<p><i>Les champs précédés d un * sont obligatoires</i></p>
	<p><input type="submit" value="S\'inscrire" /></p></form>
	</div>
	</body>
	</html>';
}
else{
    $pseudo_erreur1 = NULL;
    $pseudo_erreur2 = NULL;
    $mdp_erreur = NULL;
    $email_erreur1 = NULL;
    $email_erreur2 = NULL;
    $avatar_erreur = NULL;
    $avatar_erreur1 = NULL;
    $avatar_erreur2 = NULL;
    $avatar_erreur3 = NULL;
    $nb_erreur=0;

    $temps = time();
    $pseudo=$_POST['pseudo'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $confirm = $_POST['confirm'];

    $query=$db->prepare('SELECT COUNT(*) AS nbr FROM membres WHERE pseudo =:pseudo');
    $query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
    $query->execute();
    $used1=($query->fetchColumn()==0)?1:0;

    if(!$used1){
        $pseudo_erreur1="Pseudo déjà pris";
        $nb_erreur++;
    }

    if (strlen($pseudo) < 3)
    {
        $pseudo_erreur2 = "Votre pseudo est trop court";
        $nb_erreur++;
    }
    if (strlen($pseudo) > 15)
    {
        $pseudo_erreur2 = "Votre pseudo est trop long";
        $nb_erreur++;
    }

    if(empty($confirm) || empty($pass)){
        $mdp_erreur = "Vous n'avez pas remplis de mot de passe";
        $nb_erreur++;
    }

    if($pass != $confirm){
        $mdp_erreur = "Vous avez entré deux mots de passe différents";
        $nb_erreur++;
    }

    $query=$db->prepare('SELECT COUNT(*) AS nbr FROM membres WHERE mail =:mail');
    $query->bindValue(':mail',$email, PDO::PARAM_STR);
    $query->execute();
    $used=($query->fetchColumn()==0)?1:0;
    $query->CloseCursor();
    if(!$used)
    {
        $email_erreur1 = "Adresse email est déjà utilisée par un membre";
        $nb_erreur++;
    }
    //On vérifie la forme maintenant
    if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $email) || empty($email))
    {
        $email_erreur2 = "Votre adresse E-Mail n'est pas valide";
        $nb_erreur++;
    }

    //Vérification de l'avatars :
    if (!empty($_FILES['avatars']['size']))
    {
        //On définit les variables :
        $maxsize = 10000024; //Poid de l'image
        $maxwidth = 1000; //Largeur de l'image
        $maxheight = 1000; //Longueur de l'image
        $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'bmp' ); //Liste des extensions valides

        if ($_FILES['avatars']['error'] > 0)
        {
            $avatar_erreur = "Erreur lors du transfert de l'avatars : ";
        }
        if ($_FILES['avatars']['size'] > $maxsize)
        {
            $nb_erreur++;
            $avatar_erreur1 = "Le fichier est trop gros : (<strong>".$_FILES['avatars']['size']." Octets</strong>    contre <strong>".$maxsize." Octets</strong>)";
        }

        $image_sizes = getimagesize($_FILES['avatars']['tmp_name']);
        if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight)
        {
            $nb_erreur++;
            $avatar_erreur2 = "Image trop large ou trop longue : 
                (<strong>".$image_sizes[0]."x".$image_sizes[1]."</strong> contre <strong>".$maxwidth."x".$maxheight."</strong>)";
        }

        $extension_upload = strtolower(substr(  strrchr($_FILES['avatars']['name'], '.')  ,1));
        if (!in_array($extension_upload,$extensions_valides) )
        {
            $nb_erreur++;
            $avatar_erreur3 = "Extension de l'avatars incorrecte";
        }
    }

    if ($nb_erreur==0) {
        echo '<h1>Inscription terminée</h1>';
        echo '<p>Bienvenue sur GolrIIE</p>
	    <p>Cliquez <a href="./index.php">ici</a> pour revenir à la page d accueil</p>';
        $nomavatar=(!empty($_FILES['avatars']['size']))?move_avatar($_FILES['avatars']):'';
        echo $nomavatar;
        $query=$db->prepare('INSERT INTO membres (pseudo, mdp,mail,avatar)
        VALUES (:pseudo, :pass, :email,:nomavatar)');
        $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $query->bindValue(':pass', password_hash($pass,PASSWORD_BCRYPT), PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':nomavatar', $nomavatar, PDO::PARAM_STR);
        $query->execute();

        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['id'] = $db->lastInsertId();;
        $_SESSION['level'] = 2;
        $query->CloseCursor();
    }
    else{
        echo'<p>'.$pseudo_erreur1.'</p>';
        echo'<p>'.$pseudo_erreur2.'</p>';
        echo'<p>'.$mdp_erreur.'</p>';
        echo'<p>'.$email_erreur1.'</p>';
        echo'<p>'.$email_erreur2.'</p>';
        echo'<p>'.$avatar_erreur.'</p>';
        echo'<p>'.$avatar_erreur1.'</p>';
        echo'<p>'.$avatar_erreur2.'</p>';
        echo'<p>'.$avatar_erreur3.'</p>';
        echo'<p>Cliquez <a href="./register.php">ici</a> pour recommencer</p>';
    }


}
?>