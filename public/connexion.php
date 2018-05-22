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
$_SESSION["connect"] = 0;
?>

<html>
<head>
    <title> Connexion </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"  href="style_index.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/form.css">
</head>

<body>

<?php
menu_navigation()
?>
<br />
<br />
<br />

<div class="container">';

<div class="form-c">
<div class="form-c-head">Veuillez remplir les informations :</div>
<form method = "post" action="connect.php" >
<label for="pseudo"><span class="txt">Pseudo <span class="required">*</span></span><input type="text" class="input-field" name="pseudo" value=" "/></label>
<label for="mdp"><span class="txt">Mot de passe <span class="required">*</span></span><input type="password" class="input-field" name="mdp" value="" /></label>
<input type ="submit" name="submit" value="Se connecter"/>
</form>
</div>
</div>

</div>
</body>
