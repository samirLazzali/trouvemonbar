<?php
session_start();
require '../vendor/autoload.php';
include('menu.php');
//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();
?>

<html>
<head>
    <title> profil  </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"  href="style_index.css">
</head>
<body>

<div class="banniere">
    <?php
    menu_connexion();
    menu_navigation();
    ?>
</div>

<h1>Modifier son profil</h1>
<form method="post" action="#">
    <fieldset><legend>Prénom : </legend><input type ="text" name="prenommodif" /></fieldset>
    <fieldset><legend>Nom : </legend><input type="text" name="nommodif" /></fieldset>
    <fieldset><legend>E-mail : </legend><input type="text" name="mailmodif" /></fieldset>
    <fieldset><legend>Pseudo : </legend><input type="text" name="pseudomodif" /></fieldset>
    <fieldset><legend>nouveau mot de passe : </legend><input type ="text" name="mdpmodif" /></fieldset>
    <fieldset><legend>confirmer mot de passe : </legend><input type ="text" name="mdpmodif2" /></fieldset>
    <input type ="submit" name="submit" value="Modifier"/>
</form>

<?php
$prenom=$_SESSION['prenom'];
$nom=$_SESSION['nom'];
$email=$_SESSION['email'];
$pseudo=$_SESSION['pseudo'];
$mdp=$_SESSION['mdp'];

if (isset($_POST['prenommodif']) && $_POST['prenommodif']!=null){
    $prenom=$_POST['prenommodif'];
}
if (isset($_POST['nommodif']) && $_POST['nommodif']!=null){
    $nom=$_POST['nommodif'];
}
if (isset($_POST['mailmodif']) && $_POST['mailmodif']!=null){
    $email=$_POST['mailmodif'];
}
if (isset($_POST['pseudomodif']) && $_POST['pseudomodif']!=null){
    $pseudo=$_POST['pseudomodif'];
}
if (isset($_POST['mdpmodif']) && $_POST['mdpmodif']!=null && isset($_POST['mdpmodif2']) && $_POST['mdpmodif2']!=null){
    
}


