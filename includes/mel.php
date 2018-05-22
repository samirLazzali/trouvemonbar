<?php
if ($id==0) erreur(ERR_IS_NOT_CO);
?>

<?php
if (empty($_POST['titre'])) // Si on la variable est vide, on peut considérer qu'on est sur la page de formulaire
{
    echo '<h1>Upload</h1>';
    echo '<form method="post" action="upload.php" enctype="multipart/form-data">
	<fieldset class=cadreinscription><legend class=\'legende\'>Infos</legend><br/>
	<input class=champinscription name="titre" type="text" id="titre" placeholder="Titre" /><br /><br />
	<textarea id="description" name="description" cols="40" rows="5" placeholder="description"></textarea>(150 caractères max.)<br />
	<label for="img">Votre Image : </label><input type="file" name="img" id="img" /><br />
	</fieldset>
	<p><input class="connexion" type="submit" value="Upload" /></p></form>
	</div>
	</body>
	</html>';
}
else{
    $titre_erreur=NULL;
    $desc_erreur=NULL;
    $img_erreur=NULL;
    $img_erreur1=NULL;
    $img_erreur2=NULL;
    $img_erreur3=NULL;
    $nb_erreur=0;

    $temps = time();
    $titre=$_POST['titre'];
    $desc = $_POST['description'];

    if (strlen($pseudo) > 60 )
    {
        $titre_erreur = "Titre trop long";
        $nb_erreur++;
    }

    if(strlen($desc)>150){
        $desc_erreur= "Description trop longue";
        $nb_erreur++;
    }
    if (!empty($_FILES['img']['size']))
    {
        //On définit les variables :
        $maxsize = 10000024; //Poid de l'image
        $maxwidth = 1000; //Largeur de l'image
        $maxheight = 1000; //Longueur de l'image
        $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'bmp' ); //Liste des extensions valides

        if ($_FILES['img']['error'] > 0)
        {
            $avatar_erreur = "Erreur lors du transfert de l'avatars : ";
        }
        if ($_FILES['img']['size'] > $maxsize)
        {
            $nb_erreur++;
            $avatar_erreur1 = "Le fichier est trop gros : (<strong>".$_FILES['img']['size']." Octets</strong>    contre <strong>".$maxsize." Octets</strong>)";
        }

        $image_sizes = getimagesize($_FILES['img']['tmp_name']);
        if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight)
        {
            $nb_erreur++;
            $avatar_erreur2 = "Image trop large ou trop longue : 
                (<strong>".$image_sizes[0]."x".$image_sizes[1]."</strong> contre <strong>".$maxwidth."x".$maxheight."</strong>)";
        }

        $extension_upload = strtolower(substr(  strrchr($_FILES['img']['name'], '.')  ,1));
        if (!in_array($extension_upload,$extensions_valides) )
        {
            $nb_erreur++;
            $avatar_erreur3 = "Extension de l'avatars incorrecte";
        }
    }
    else{
        $img_erreur="Vous n'avez pas upload d'image";
        $nb_erreur++;
    }

    if ($nb_erreur==0) {
        echo '<h1>Upload terminé</h1>
	    <p><a href="./index.php">Cliquez ici pour revenir à la page d accueil</a> </p>';
        $nomposts=move_posts($_FILES['img']);
        $query=$db->prepare('INSERT INTO posts (titre, description,img,author)
        VALUES (:titre,:description, :img,:author)');
        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':description', $desc, PDO::PARAM_STR);
        $query->bindValue(':img', $nomposts, PDO::PARAM_STR);
        $query->bindValue(':author', $id, PDO::PARAM_INT);
        $query->execute();
        $query->CloseCursor();
    }
    else{
        echo'<p>'.$titre_erreur.'</p>';
        echo'<p>'.$desc_erreur.'</p>';
        echo'<p>'.$img_erreur.'</p>';
        echo'<p>'.$img_erreur1.'</p>';
        echo'<p>'.$img_erreur2.'</p>';
        echo'<p>'.$img_erreur3.'</p>';
        echo'<p>Cliquez <a href="./upload.php">ici</a> pour recommencer</p>';
    }

}