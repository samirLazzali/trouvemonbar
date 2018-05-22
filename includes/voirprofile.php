<?php
$titre="Profil";
if ($id==0) erreur(ERR_IS_NOT_CO);
$action = isset($_GET['action'])?htmlspecialchars($_GET['action']):'consulter';
$membre = isset($_GET['m'])?(int) $_GET['m']:'';
?>


<?php
    switch($action){
        case "consulter":
            $query=$db->prepare('SELECT pseudo, avatar,
       mail FROM membres WHERE id=:membre');
            $query->bindValue(':membre',$membre, PDO::PARAM_INT);
            $query->execute();
            $data=$query->fetch();

            echo'<h1>Profil de '.stripslashes(htmlspecialchars($data['pseudo'])).'</h1>';

            echo'<img src="./avatars/'.$data['avatar'].'"alt="Ce membre n\'a pas d\'avatar" />';

            echo'<p class="adressmail"><strong>Adresse E-Mail : </strong> <a href="mailto:'.stripslashes($data['mail']).'">'.stripslashes(htmlspecialchars($data['mail'])).'</a><br /><br />';
            $query->CloseCursor();
            if ($membre==$_SESSION["id"]|| $_SESSION["level"]==3) {
                echo '<a href="./profile.php?m='.$membre.'&action=modifier" >Cliquez ici pour modifier votre profil </a>';
            }
            break;
        case "modifier":
            if($_SESSION["id"]!=$membre && $_SESSION["level"]!=3){
                erreur(NO_ACCESS);
            }
            else{
                if (empty($_POST['sent']))
                {
                    //On prend les infos du membre
                    $query=$db->prepare('SELECT pseudo, mail,avatar FROM membres WHERE id=:id');
                    $query->bindValue(':id',$membre,PDO::PARAM_INT);
                    $query->execute();
                    $data=$query->fetch();
                    echo '<h1>Modifier le profil de '.$data["pseudo"].'</h1>';

                    echo '<form method="post" action="profile.php?m='.$membre.'&action=modifier" enctype="multipart/form-data">
                            <fieldset class=cadreinscription><legend class=\'legende\'>Identifiants</legend><br />
                            Pseudo : <strong>' . stripslashes(htmlspecialchars($data['pseudo'])) . '</strong><br /><br />
                            <input class=champinscription type="password" name="password" placeholder="nouveau mot de passe" id="password" /><br /><br />
                            <input class=champinscription type="password" name="confirm" placeholder="confirmez le nouveau mot de passe" id="confirm"  /><br />
                            </fieldset><br />
                     
                            <fieldset class=cadreinscription><legend class=\'legende\'>Contacts</legend>
                            <input class=champinscription type="text" name="email" placeholder="nouvel E-mail" id="email"
                            value="' . stripslashes($data['mail']) . '" /><br />
                            </fieldset><br />
                                   
                            <fieldset class=cadreinscription><legend class=\'legende\'>Profil sur GolrIIE</legend>
                            <input type="file" name="avatar" id="avatar" /><br /><br />
                            <input type="checkbox" name="delete" value="Delete" />
                            Supprimer l avatar</>
                            Avatar actuel :
                            <img src="./avatars/' . $data['avatar'] . '"
                            alt="pas d avatar" />
                         
                         
                         
                            </fieldset>
                            <p>
                            <input class=connexion type="submit" value="Modifier son profil" />
                            <input type="hidden" id="sent" name="sent" value="1" />
                            </p></form>';
                    $query->CloseCursor();
                }
                else{
                    $mdp_erreur = NULL;
                    $email_erreur1 = NULL;
                    $email_erreur2 = NULL;
                    $avatar_erreur = NULL;
                    $avatar_erreur1 = NULL;
                    $avatar_erreur2 = NULL;
                    $avatar_erreur3 = NULL;
                    $nb_erreur=0;
                    $mdpC1=0;
                    $avatarC1=0;
                    $mailC1=0;


                    $email = $_POST['email'];
                    $pass = $_POST['password'];
                    $confirm = $_POST['confirm'];

                    if(!empty($confirm) || !empty($pass)){
                        $mdpC1=1;
                    }

                    if($pass != $confirm){
                        $mdp_erreur = "Vous avez entré deux mots de passe différents";
                        $nb_erreur++;
                    }
                    $query=$db->prepare('SELECT mail FROM membres WHERE id =:id');
                    $query->bindValue(':id',$membre,PDO::PARAM_INT);
                    $query->execute();
                    $data=$query->fetch();
                    if (strtolower($data['mail']) != strtolower($email)) {
                        $mailC1=1;
                        $query = $db->prepare('SELECT COUNT(*) AS nbr FROM membres WHERE mail =:mail');
                        $query->bindValue(':mail', $email, PDO::PARAM_STR);
                        $query->execute();
                        $used = ($query->fetchColumn() == 0) ? 1 : 0;
                        $query->CloseCursor();
                        if (!$used) {
                            $email_erreur1 = "Adresse email est déjà utilisée par un membre ";
                            $nb_erreur++;
                        }
                        //On vérifie la forme maintenant
                        if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $email) || empty($email)) {
                            $email_erreur2 = "Votre adresse E-Mail n'est pas valide";
                            $nb_erreur++;
                        }
                    }
                    //Vérification de l'avatars :
                    if (!empty($_FILES['avatar']['size']))
                    {
                        //On définit les variables :
                        $avatarC1=1;
                        $maxsize = 10000024; //Poid de l'image
                        $maxwidth = 1000; //Largeur de l'image
                        $maxheight = 1000; //Longueur de l'image
                        $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'bmp' ); //Liste des extensions valides

                        if ($_FILES['avatar']['error'] > 0)
                        {
                            $avatar_erreur = "Erreur lors du transfert de l'avatars : ";
                        }
                        if ($_FILES['avatar']['size'] > $maxsize)
                        {
                            $nb_erreur++;
                            $avatar_erreur1 = "Le fichier est trop gros : (<strong>".$_FILES['avatar']['size']." Octets</strong>    contre <strong>".$maxsize." Octets</strong>)";
                        }

                        $image_sizes = getimagesize($_FILES['avatar']['tmp_name']);
                        if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight)
                        {
                            $nb_erreur++;
                            $avatar_erreur2 = "Image trop large ou trop longue : 
                (<strong>".$image_sizes[0]."x".$image_sizes[1]."</strong> contre <strong>".$maxwidth."x".$maxheight."</strong>)";
                        }

                        $extension_upload = strtolower(substr(  strrchr($_FILES['avatar']['name'], '.')  ,1));
                        if (!in_array($extension_upload,$extensions_valides) )
                        {
                            $nb_erreur++;
                            $avatar_erreur3 = "Extension de l'avatars incorrecte";
                        }
                    }

                    if ($nb_erreur==0) {

                        if($mdpC1){
                            $query=$db->prepare('UPDATE membres SET mdp = :mdp  WHERE id = :id');
                            $query->bindValue(':mdp',password_hash($pass,PASSWORD_BCRYPT),PDO::PARAM_STR);
                            $query->bindValue(':id',$id,PDO::PARAM_INT);
                            $query->execute();
                            $query->CloseCursor();
                        }
                        if($avatarC1){
                            $nomavatar=move_avatar($_FILES['avatar']);
                            $query=$db->prepare('UPDATE membres SET avatar = :avatar  WHERE id = :id');
                            $query->bindValue(':avatar',$nomavatar,PDO::PARAM_STR);
                            $query->bindValue(':id',$id,PDO::PARAM_INT);
                            $query->execute();
                            $query->CloseCursor();

                        }
                        if (isset($_POST['delete']))
                        {
                            $query=$db->prepare('UPDATE membres SET avatar="" WHERE id = :id');
                            $query->bindValue(':id',$id,PDO::PARAM_INT);
                            $query->execute();
                            $query->CloseCursor();
                        }
                        if($mailC1){
                            $query=$db->prepare('UPDATE membres SET mail = :mail  WHERE id = :id');
                            $query->bindValue(':mail',$email,PDO::PARAM_STR);
                            $query->bindValue(':id',$id,PDO::PARAM_INT);
                            $query->execute();
                            $query->CloseCursor();

                        }

                        if ($mdpC1 || $mailC1 || $avatarC1 || isset($_POST['delete']) ){
                            echo'<h1>Modification terminée</h1>';
                            echo'<p>Votre profil a été modifié avec succès !</p>';
                            echo'<p>Cliquez <a href="./index.php">ici</a>  pour revenir à la page d accueil</p>';
                        }
                        else{
                            echo '<p>Vous n\'avez rien modifié sur votre profil</p>';
                            echo'<p>Cliquez <a href="./index.php">ici</a>  pour revenir à la page d accueil</p>';
                        }
                    }
                    else {
                        echo'<p>'.$mdp_erreur.'</p>';
                        echo'<p>'.$email_erreur1.'</p>';
                        echo'<p>'.$email_erreur2.'</p>';
                        echo'<p>'.$avatar_erreur.'</p>';
                        echo'<p>'.$avatar_erreur1.'</p>';
                        echo'<p>'.$avatar_erreur2.'</p>';
                        echo'<p>'.$avatar_erreur3.'</p>';
                        echo'<p>Cliquez <a href="profile.php?m='.$membre.'&action=modifier">ici</a> pour recommencer</p>';


                    }

                }
                break;



            }
    }