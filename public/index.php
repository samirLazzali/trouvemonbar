<?php
require '../vendor/autoload.php';

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
    <title> Apéral  </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"  href="style_index.css">
</head>
<body>

<div id="menu_bouton">
    <div classe="bouton"><input type="submit" value="Acceuil" ></div>
    <div classe="bouton"><input type="submit" value="Apéral" ></div>
    <div classe="bouton"><input type="submit" value="Oenologiie" ></div>
    <div classe="bouton"><input type="submit" value="Réunion" ></div>
    <div classe="bouton"><input type="submit" value="Classement" ></div>
    <div classe="bouton"><input type="submit" value="Admin" ></div>
</div>

<div id="boutons_connexion">
    <div classe="bouton"><input type="submit" value="s'inscrire" ></div>
    <div classe="bouton"><input type="submit" value="Se connecter" ></div>
</div>

<div class="container">
    <h3><?php echo 'Bienvenue sur le site des boloss !' ?></h3>

    <table class="table table-bordered table-hover table-striped">
        <thead style="font-weight: bold">
            <td>#</td>
	    <td>Prénom</td>
            <td>Nom</td>
            <td>Score</td>
        </thead>
        <?php /** @var \User\User $user */
        foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user->getId() ?></td>
                <td><?php echo $user->getPrenom() ?></td>
                <td><?php echo $user->getNom() ?></td>
                <td><?php echo $user->getScore() ?> points</td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<form method="get" action="connect.php">
<fieldset><legend>Pseudo : </legend><input type="text" name="pseudo"/></fieldset>
<fieldset><legend>Mot de passe : </legend><input type="password" name="mdp"/></fieldset>
<input type="submit" name="submit" value="Se connecter"/>
</form>

<h4>Prochaine réunion</h4>
<div id="prochaine_réunion">
    <?php echo $date_réunion ?>
    <input type="submit" value="Participer">
</div>
</body>
</html>

