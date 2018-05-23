<?php
/**
 * Identite
 *
 * PHP Version 7.0
 *
 * @category Identite
 * @package  Public
 * @author   Eric COLONIA <ercol@outlook.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost:8080/index.php
 */
session_name("EmpruntBaka");
session_start();
require "connexion.php";
$visiteur="visiteur";
$admin=0;
if (isset($_POST['login']) && isset($_POST['password'])) {
    $_SESSION['login']=$_POST['login'];
    $_SESSION['password']=sha1($_POST['password']);
}
if (!isset($_SESSION['login'])) {
    $_SESSION['login']=$visiteur;
    echo "<script> window.location.replace('index.php')</script>";
    exit;
}


if ($_SESSION['login']!=$visiteur) {
    global $connection;
    $exe= new Execute($connection); 
    $requete="Select * from bakabar_logins JOIN membre_emprunt 
		on bakabar_logins.login=membre_emprunt.pseudo 
		where bakabar_logins.login = '$_SESSION[login]';";
    $rows=$exe->exec_sql($requete);
    $sousrequete="Select count(*) as count from bakabar_logins JOIN membre_emprunt 
		on bakabar_logins.login=membre_emprunt.pseudo 
		where bakabar_logins.login='$_SESSION[login]'";
    $count=$exe->exec_sql($sousrequete);
    if (sizeof($rows) != 0 ) {
        $admin=1;
    } else {
        $req="Select * from membre_emprunt where pseudo='$_SESSION[login]';";
        $rows=$exe->exec_sql($req);
        $sousrequete="Select count(*) from membre_emprunt 
			where pseudo='$_SESSION[login]'";
        $count=$exe->exec_sql($sousrequete);

        if (sizeof($rows)==0 ) {
            $_SESSION['login']=$visiteur;
            echo "<script> 
				window.location.replace('pageconnexion.php?wronglogin')
</script>";
            exit;
        }

    }
    $req="Select password from membre_emprunt where pseudo='$_SESSION[login]';";
    $rows=$exe->exec_sql($req);


    foreach($rows as $row):
        if ($row->password != $_SESSION['password']) {
            $_SESSION['login']=$visiteur;
            echo "<script> 
				window.location.replace('pageconnexion.php?wrongpass')
</script>";
            exit;
        }
    endforeach;
 
}
?>
