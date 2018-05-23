<?php
/**
 * Created by PhpStorm.
 * User: clement
 * Date: 17/04/18
 * Time: 21:28
 */
session_start();
require '../../vendor/autoload.php';
include("db.php");

function verif_authent() {
    global $AUTHENT;
    if($AUTHENT == 1)
        if(!$_SESSION['nomuser']) {
            header('Location: Connexion.php');
        }
}


function verif_uname($uname) {
    global $pseudo;
    $connection = db_connect();
    $users = db_fetchAll_Users($connection);
    foreach ($users as $user){
        if (($testmdp=$user->getPseudo()) == $uname){
            $_SESSION['nomuser'] = $user->getPseudo();
            $_SESSION['birthday'] = $user->getBirthday();
            return true;
        }
    }
    return false;
}

function verif_mdp($mdp,$uname) {
    global $pseudo;
    $connection = db_connect();
    $users = db_fetchAll_Users($connection);
    foreach ($users as $user){
        if (($testmdp=$user->getMdp()) == $mdp && $testmdp=$user->getPseudo() == $uname){
            $_SESSION['nomuser'] = $user->getPseudo();
            //$_SESSION['mdp'] = $user->
            //$_SESSION['birthday'] = $user->getBirthday();
            return true;
        }
    }
    return false;
}

function detruire_session() {
    session_unset() ;
    session_destroy();
}


function liste_mangas(){
    if ($db = pg_connect()) {
        $req = "SELECT nom FROM manga ";
        $rep = pg_query($db, $req);
        if ($rep) {
            $row = pg_fetch_array($rep);
            pg_close($db);
            print "<select name='manga'>";
            foreach ($row as $r){
                print "<option value='$r'>$r</option>";
            }
            print "</select><br/>";
            return;
        }
    }
    print "echec liste mangas";
}


function create_manga(){
    $manga = $_POST['nom'];
    if ($db = pg_connect()) {
        $req_list = "SELECT nom FROM manga ";
        $rep = pg_query($db, $req_list);
        if($rep){
            $row = pg_fetch_array($rep);
            foreach($row as $r){
                if ($r === $manga){
                    print "erreur : le manga existe déjà\n";
                    exit(1);
                }
            }
            $req_new = "INSERT INTO manga(nom, auteur, genre, statut, note, nb_notes, nb_chap, debut, fin) VALUES ('".$_POST['nom']."','".$_POST['auteur']."','".$_POST['genre']."','".$_POST['statut']."','0','0','0','".$_POST['debut']."','".$_POST['fin'].")";
            if (pg_query($db,$req_new)){
                print "nouveau manga $manga ajouté\n";
            }
        }
    }
}

function deleteDir($dirPath) {
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}

function new_dir($manga,$chapitre){
    mkdir("$manga/$chapitre");
}


function create_client($uname,$mdp, $dnais) {
    if ( $db = db_connect()) {
        $stmt = $db->prepare("INSERT INTO \"users\"(pseudo, mdp, birthday, admin) VALUES ('$uname', '$mdp', '$dnais', 'FALSE')");
        $stmt->execute();
        return true;
    }
    else {
        return false;
    }
}


function correte_mdp($uname, $dnais){

    $connection = db_connect();
    $users = db_fetchAll_Users($connection);
    foreach ($users as $user){
        if ($testmdp=$user->getPseudo() == $uname){
            if ($testmdp=$user->getBirthday() == $dnais) {
                return true;
            }
            affiche_erreur("Username errone.");
        }
        affiche_erreur("Dnais errone.");
    }
    return false;
}


function update_client($uname, $dnais) {
    if ( $db = db_connect()) {
        $stmt = $db->prepare("UPDATE \"users\" SET birthday = '$dnais' WHERE pseudo = '$uname'");
        $stmt->execute();
        return true;
    }
    else {
        return false;
    }
}


function changeMDP($uname, $mdp){
    if ( $db = db_connect()) {
        $stmt = $db->prepare("UPDATE \"users\" SET mdp = '$mdp' WHERE pseudo = '$uname'");
        $stmt->execute();
        return true;
    }
    else {
        return false;
    }
}


?>