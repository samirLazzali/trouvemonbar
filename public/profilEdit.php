<?php
$nom = $_POST['Nom'];
$prenom = $_POST['Prenom'];
$pseudo = $_POST['Pseudo'];
$mail = $_POST['Mail'];
$tel = $_POST['Tel'];
$mdp = $_POST['password1'];
$mdp2 = $_POST['password2'];
if ((! isset($nom)) | (!isset($prenom))|(!isset($pseudo)) |(! isset($mail)) | (! isset($tel)) |(! isset($mdp)) | (! isset($mdp2))
    |$nom=="" |$prenom == ""|$pseudo == ""|$mail == ""|$tel == ""|$mdp == ""|$mdp2 == ""){
    echo '<body onLoad="alert(\'un ou plusieurs champ du formulaire n ont pas été complété\')">';
    echo '<meta http-equiv="refresh" content="0;URL=creationUtilisateur.html">';
}
else
{
    $pass_hache = password_hash($mdp, PASSWORD_DEFAULT);   // hashage du mot de passe
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    try
    {
        $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    }
    catch(Exeption $e){
        die('Erreur : ');
    }
    session_start();
    $identifiant = $_SESSION['login'];
    $s=$connection->query("UPDATE compte SET nom='$nom',prenom='$prenom', pseudo='$pseudo', mail='$mail',telephone='$tel',mdp='$pass_hache' WHERE pseudo='$identifiant'");
    $_SESSION['login'] = $pseudo;
    $_SESSION['pwd'] = $mdp;
    header ('location: index.php');
}
?>
