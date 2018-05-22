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
<header>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="parametres.css">
    <h1>PinTutu</h1>
    <div class="parametre">
    </div>
</header>
<body>

<div class="container">
    <h2><?php echo 'Bienvenue sur PinTutu ! ' ; ?></h2>

    <?php
    echo '<form action="identification.php" formmethod="get" >
				Identifiant <input type="text" size="20" maxlength="18" name="identifiant"><br/>
				Mot de passe <input type="password" size="20" maxlength="18" name="password"><br/>';
	echo '<input type="submit" name="action" value="Connexion">';
	echo '</form>';
	echo '<form action="comptes.php" formmethod="post">';
	echo '<input type="submit" value="S\'inscrire">';
	echo '</form>';
    ?>

   <!-- <table class="table table-bordered table-hover table-striped">
        <thead style="font-weight: bold">
            <td>Pseudo</td>
            <td>Prenom</td>
            <td>Nom</td>
            <td>Mail</td>
        </thead>
        <?php /** @var \User\User $user */
        foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user->getPseudo() ?></td>
                <td><?php echo $user->getPrenom() ?></td>
                <td><?php echo $user->getNom() ?></td>
                <td><?php echo $user->getMail() ?> </td>
            </tr>
        <?php endforeach; ?>
    </table>-->
</div>
</body>
</html>
