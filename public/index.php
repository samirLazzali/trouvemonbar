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
    <title> Acceuil  </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"  href="style_index.css">
</head>
<body>
<form method="post" action="changement_de_page.php" id="menu_bouton">
    <div classe="bouton"><input type="submit" name="acc" value="Accueil" ></div>
    <div classe="bouton"><input type="submit" name="ap" value="Apéral" ></div>
    <div classe="bouton"><input type="submit" name="oe" value="Oenologiie" ></div>
    <div classe="bouton"><input type="submit" name="reu" value="Réunion" ></div>
    <div classe="bouton"><input type="submit" name="clas" value="Classement" ></div>
    <div classe="bouton"><input type="submit" name="adm" value="Admin" ></div>
</form>

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

<h1>Se connecter</h1>
<br />
<form method="post" action="connect.php">
<fieldset><legend>Pseudo : </legend><input type="text" name="pseudo"/></fieldset>
<fieldset><legend>Mot de passe : </legend><input type="password" name="mdp"/></fieldset>
<input type="submit" name="submit" value="Se connecter"/>
</form>
<br />

<h1>S'inscrire</h1>
<br />
<form method = "post" action="inscription.php">
<fieldset><legend>Prénom : </legend><input type ="text" name="prenominsc" /></fieldset>
<fieldset><legend>Nom : </legend><input type="text" name="nominsc" /></fieldset>
<fieldset><legend>E-mail : </legend><input type="text" name="mailinsc" /></fieldset>
<fieldset><legend>Pseudo : </legend><input type="text" name="pseudoinsc" /></fieldset>
<fieldset><legend>Mot de passe : </legend><input type ="text" name"mdpinsc" /></fieldset>
<input type ="submit" name="submit" value="S'inscrire"/>
<br />

<h4>Prochaine réunion</h4>
<form action id="prochaine_réunion">
    <?php echo $date_reunion ?>
    <input type="submit" value="Participer">
</form>
</body>
</html>

