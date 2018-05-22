<?php

require '../vendor/autoload.php';

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

session_start();


if ($_SESSION['identifiant']==NULL) {
    echo 'SESSION EXPIRE';
    echo '<form action="index.php" formmethod="get" >';
    echo '<input type="submit" value="Retour">';
    echo '</form>';
}
else {
    $user = $_SESSION['identifiant'];
}
?>
<html>
<link rel="stylesheet" href="parametres.css" type="text/css">
    <body>
    <header>
        <h1>PinTutu</h1>
        <div class="parametre">
            <form action="main2.php" formethod="post">
                <input type="submit" name="ParamÃ¨tres" value="Menu principal"/>
            </form>
            <form action="ajout.php" formethod="post">
                <input type="submit" name="ajout" value="Ajouter du contenu"/>
            </form>
        </div>
    </header>
    <body>
    <form action="parametres.php" formmethod="get" >
    Ancien Mot de Passe
    <input type="password" size="20" maxlength="18" name="old"></br>
    Nouveau Mot de Passe
    <input type="password" size="20" maxlength="18" name="new"></br>
    <input type="submit" name='modif_mdp'>
    </body>
