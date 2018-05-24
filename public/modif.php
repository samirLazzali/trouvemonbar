<?php
include("Vue.php");
include ("db.php");

    $mdp= $_POST['mdp'];
    $mdpv=$_POST['mdpv'];
    $user=$_POST['identif'];
    $prec_user=$_POST['prec_user'];
    $test=true;
    if ($user == "" || $mdp=="")
    {
        affiche_info("Identifiant ou mot de passe invalide (vide)");
        $test=false;
    }
    if ($mdp!=$mdpv)
    {
        affiche_info("Les mots de passe de coincident pas.");
        $test=false;
    }
    if ($test) {
        //verif $user non utilisé dans BD
        $db=db_connect();
        $res=db_query($db,"SELECT id_eleve FROM \"projet_bda\".\"Eleve\" WHERE id_eleve='$user';");
        db_fetch($res);
        if (db_count($res)!=0 || (db_count($res)==1 && $prec_user!=$user))
        {
            affiche_info("Identifiant déjà aloué.");
            $test=false;
        }
        else
        {
            $mdp = sha1($mdp);
            db_query($db,"UPDATE \"projet_bda\".\"Eleve\" SET mdp='$mdp' WHERE id_eleve='$prec_user';");
            db_query($db,"UPDATE \"projet_bda\".\"Eleve\" SET id_eleve='$user' WHERE id_eleve='$prec_user';");
            affiche_info("Compte modifié");
        }
        db_close($res);
        //MAJ BD
    }
    print "<a href=\"authentification.php\">Retour Authentification</a><br/>\n";
    print "<a href=\"index.php\">Menu</a><br/>\n";
    ?>