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
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css"  href="style_index.css">
        </head>

<?php
    if (isset($_SESSION['connect']) && $_SESSION['connect']>=1) {
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
    echo '</body>';


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
    if (isset($_POST['mdpmodif']) && $_POST['mdpmodif'] != null && isset($_POST['mdpmodif2'])) {
        if ($_POST['mdpmodif2'] != null && $_POST['mdpmodif'] == $_POST['mdpmodif2']) {
            $mdp = $_POST['mdpmodif'];
        }
        else{
            echo 'les deux mot de passe doivent être identique';
        }
    }

    $req = $connection->prepare('UPDATE public.user SET prenom=:prenom, nom=:nom, mdp=:mdp, mail=:mail, pseudo=:pseudo WHERE id=:id');
    $test = $req->execute([':prenom' => $prenom,
        ':nom' => $nom,
        ':mdp' => $mdp,
        ':mail' => $email,
        ':pseudo' => $pseudo,
        ':id' => $_SESSION['id'],
    ]);
}
else {
        echo '<body>';
        echo '<h2>veuillez vous connecter pour acceder à cette page</h2>';
        echo '<a href="connexion.php">connexion</a>';
}
?>
</html>


