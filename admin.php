<?php
/**
 * Devenir admin
 *
 * PHP Version 7.0
 *
 * @category Administrateur
 * @package  Connexion
 * @author   Eric COLONIA <ercol@outlook.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost:8080/admin.php
 */
 require "identite.php";
if (isset($_GET['membre'])) {
    $user=$_GET['membre'];
}
?>
<html>
<head>

</head>
<body>
<?php
if (isset($_POST['password'])) {
    global $connection;
    global $user;
    $exe=new Execute($connection);
    $pass=sha1($_POST['password']);
    $req="Select max(id) AS max from bakabar_logins ; ";
    $ids=$exe->exec_sql($req);
    foreach($ids as $id) :
        $nb=$id->max;
    endforeach;
    $nb++;
    $exe->insert_bakabar($user, $pass, $nb);


?>


<?php
echo "<script>window.location.replace('index.php?admin')
</script>";
            exit;


} else {
?>
<div class="form">
<form action="admin.php?membre=<?php echo $user; ?>" method='post'/>
Entrez le mot de passe du nouvel administrateur :
 </br>
<input type='password' name='password' placeholder="password"/>
<input type="submit" value="Upgrade!" />
</form>
</div>
<?php
}
?>
<a href="index.php"> Retour a l'index </a>
</body>
</html>
