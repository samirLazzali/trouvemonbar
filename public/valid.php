<?php

include("Vue.php");
include ("db.php");

    $mdp= $_POST['mdp'];
    $user=$_POST['identif'];
// si le numéro de client n'a pas été renseigné
if ( $user == "" ) {
    affiche_erreur("Vous devez impérativement taper un identifiant de client");
}

// si le mdp de client n'a pas été renseigné
elseif ($mdp == "" ) {
    affiche_erreur("Vous devez impérativement taper un mot de passe de client");
}
else{
    $mdp=sha1($mdp);

        //verif BD
    $test=true;
    if ($_POST['choix']!="c") {
        $db = db_connect();
        $test = true;
        $res = db_query($db, "SELECT id_eleve,mdp FROM \"projet_bda\".\"Eleve\" WHERE id_eleve='$user' ;");
        db_fetch($res);
        if (db_count($res) == 0 && $_POST['choix'] != "c") {
            $test = false;
            affiche_info("Identifiant non alloué");
        }
        else {
            $ligne = $res->fetch();
            $mdpa = $ligne->mdp;
            if ($mdpa != $mdp) {
                $test = false;
                affiche_info("Mauvais mot de passe");
            }
        }
        db_close($res);
    }
    if ($test &&  $_POST['choix']!="a"){
// si on ne veut pas s'identifier
        $choix=$_POST['choix'];
        if ($choix == "c")
        {
            $db=db_connect();
            $res=db_query($db,"SELECT * FROM \"projet_bda\".\"Eleve\" WHERE id_eleve='$user';");
            db_fetch($res);
            if (db_count($res)>0)
            {
                affiche_info("Identifiant déjà alloué.");
            }
            else
            {
                echo '<form action="ajout.php" method="post">'.
                    ajout_champ('text', '', 'pseudo', 'Votre pseudo:', 'pseudo', 1).'<br/>'.
                    ajout_champ('text', '', 'prenom', 'Votre prénom', 'prenom', 1).'<br/>'.
                    ajout_champ('text', '', 'nom', 'Votre nom', 'nom', 1).'<br/>'.
                    ajout_champ('hidden', $user, 'user', '', 'user', 1).'<br/>'.
                    ajout_champ('hidden', $mdp, 'mdp', '', 'mdp', 1).'<br/>'.
                    ajout_champ('submit', 'Envoyer', 'soumission', '', '', 0)."\n".
                    '</form>';
            }
            db_close($res);
        }
        else
        {
            echo '<form action="modif.php" method="post">'.
                ajout_champ('text', '', 'identif', 'Nouvel identifiant', 'identif', 1).'<br/>'.
                ajout_champ('password', '', 'mdp', 'Nouveau mot de passe', 'mdp', 1).'<br/>'.
                ajout_champ('password', '', 'mdpv', 'Valider mot de passe', 'mdpv', 1).'<br/>'.
                ajout_champ('hidden',$user,'prec_user','','prec_user',1).
                ajout_champ('submit', 'Envoyer', 'soumission', '', '', 0)."\n".
                '</form>';
        }
    }
    elseif ($test)
    {
        $db=db_connect();
        $res=db_query($db,"SELECT pseudo,droits FROM \"projet_bda\".\"Eleve\" WHERE id_eleve='$user';");
        db_fetch($res);
        $ligne=$res->fetch();
        $_SESSION['pseudo']=$ligne->pseudo;
        $_SESSION['user']=$user;
        $_SESSION['droits']=$ligne->droits;
        affiche_info("Bonjour ".$ligne->pseudo);
        db_close($res);
    }
    if (!$test)
    {
        affiche_info("Mauvaise identification.");
    }
    print "<a href=\"authentification.php\">Retour Authentification</a><br/>\n";
    print "<a href=\"index.php\">Menu</a><br/>\n";
}