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

if (isset($_SESSION['connect']) && $_SESSION['connect']>=1) {
    echo '<html>';
    echo '<head>';
    echo '<title> profil  </title>';
    echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
    echo '<link rel="stylesheet" type="text/css"  href="style_index.css">';
    echo '</head>';
    echo '<body>';

    echo '<div class="banniere">';
    menu_connexion();
    menu_navigation();
    echo '</div>';

    echo '<h1>Modifier son profil</h1>';
    echo '<form method="post" action="#">';
    echo '    <fieldset><legend>Prénom : </legend><input type ="text" name="prenommodif" /></fieldset>';
    echo '    <fieldset><legend>Nom : </legend><input type="text" name="nommodif" /></fieldset>';
    echo '    <fieldset><legend>E-mail : </legend><input type="text" name="mailmodif" /></fieldset>';
    echo '    <fieldset><legend>Pseudo : </legend><input type="text" name="pseudomodif" /></fieldset>';
    echo '    <fieldset><legend>nouveau mot de passe : </legend><input type ="text" name="mdpmodif" /></fieldset>';
    echo '   <fieldset><legend>confirmer mot de passe : </legend><input type ="text" name="mdpmodif2" /></fieldset>';
    echo '   <input type ="submit" name="submit" value="Modifier"/>';
    echo '</form>';


    $prenom = $_SESSION['prenom'];
    $nom = $_SESSION['nom'];
    $email = $_SESSION['email'];
    $pseudo = $_SESSION['pseudo'];
    $mdp = $_SESSION['mdp'];

    if (isset($_POST['prenommodif']) && $_POST['prenommodif'] != null) {
        $prenom = $_POST['prenommodif'];
    }
    if (isset($_POST['nommodif']) && $_POST['nommodif'] != null) {
        $nom = $_POST['nommodif'];
    }
    if (isset($_POST['mailmodif']) && $_POST['mailmodif'] != null) {
        $email = $_POST['mailmodif'];
    }
    if (isset($_POST['pseudomodif']) && $_POST['pseudomodif'] != null) {
        $pseudo = $_POST['pseudomodif'];
    }
    if (isset($_POST['mdpmodif']) && $_POST['mdpmodif'] != null && isset($_POST['mdpmodif2']) && $_POST['mdpmodif2'] != null && $_POST['mdpmodif'] == $_POST['mdpmodif2']) {
        $mdp = $_POST['mdpmodif'];
    }

    $req = $connection->prepare('UPDATE public.user SET prenom:prenom, nom=:nom, mdp=:mdp, mail=:mail pseudo=:pseudo WHERE id=$_SESSION["id"]');
    $test = $req->execute(['prenom' => $prenom,
        'nom' => $nom,
        'mdp' => $mdp,
        'mail' => $email,
        'pseudo' => $pseudo,
    ]);
}
else {
    echo '<h2>veuillez vous connecter pour acceder à cette page</h2>';
    echo '<a href="connexion.php">connexion</a>';
}



