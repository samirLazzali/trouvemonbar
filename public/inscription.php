<?php
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
        <title> inscription  </title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css"  href="style_index.css">
    </head>
    <body>

<?php
menu_connexion();
menu_navigation()
?>

<h1>S'inscrire</h1>
<br />
<form method = "post" >
    <fieldset><legend>Prénom : </legend><input type ="text" name="prenominsc" /></fieldset>
    <fieldset><legend>Nom : </legend><input type="text" name="nominsc" /></fieldset>
    <fieldset><legend>E-mail : </legend><input type="text" name="mailinsc" /></fieldset>
    <fieldset><legend>Pseudo : </legend><input type="text" name="pseudoinsc" /></fieldset>
    <fieldset><legend>Mot de passe : </legend><input type ="text" name="mdpinsc" /></fieldset>
    <input type ="submit" name="submit" value="S'inscrire"/>
</form>

<?php
if (isset($_POST['nominsc']) && $_POST!=null) {   //améliorer la condition
    $req = $connection->prepare('INSERT INTO public.user(id,prenom,nom,score,pseudo,mdp,mail,inscription) VALUES(:id,:prenom,:nom,:score,:pseudo,:mdp,:mail,:inscription)');
    $test = $req->execute(['id' => 1, /* A CHANGER*/
        'prenom' => $_POST['prenominsc'],
        'nom' => $_POST['nominsc'],
        'score' => 0,
        'pseudo' => $_POST['pseudoinsc'],
        'mdp' => $_POST['mdpinsc'],
        'mail' => $_POST['mailinsc'],
        'inscription' => 1   //je ne sais pas ce que c'est
    ]);
    echo "test réussi ? : $test";
}
?>