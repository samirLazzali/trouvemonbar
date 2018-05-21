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
            <title> Profil  </title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	    <link rel="stylesheet" type="text/css"  href="style_index.css">
	    <link rel="stylesheet" href="css/bootstrap.css">
	    <link rel="stylesheet" href="css/style.css">
	    <link rel="stylesheet" href="css/form.css">

        </head>

<?php
    if (isset($_SESSION['connect']) && $_SESSION['connect']>=1) {
    echo '<body>';

    menu_navigation();
    echo '<br />';
    echo '<br />';
    echo '<br />';

    echo '<div class="gtco-container">';

    echo '<div class="form-c">';
    echo '<div class="form-c-head">Modifier son profil :</div>';
    echo '<form method = "post" action="#">';
    echo '<label for="prenommodif"><span class="txt">Prénom</span><input type="text" class="input-field" name="prenommodif" value="" /></label>';
    echo '<label for="nommodif"><span class="txt">Nom </span><input type="text" class="input-field" name="nommodif" value="" /></label>';
    echo '<label for="mailmodif"><span>E-mail </span><input type="text" class="input-field" name="mailmodif" value="" /></label>';
    echo '<label for="pseudomodif"><span>Pseudo </span><input type="text" class="input-field" name="pseudomodif" value="" /></label>';
    echo '<label for="mdpmodif"><span>Nouveau mot de passe</span><input type="text" class="input-field" name="mdpmodif" value="" /></label>';
    echo '<label for="mdpmodif2"><span>Confirmer le mot de passe <span class="required">*</span></span><input type="text" class="input-field" name="mdpmodif2" value="" /></label>';
    echo '<br />';
    echo '<input type ="submit" name="submit" value="Modifier"/>';
    echo '</form>';
    echo '</div>';
    echo '</div>';

    echo '</div>';
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
            echo 'Les deux mots de passe doivent être identiques';
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
    echo '<div class="gtco-container">';
    echo '<br />';
    echo '<br />';
        echo '<h2>Veuillez vous connecter pour accéder à cette page</h2>';
	echo '<a href="connexion.php">Connexion</a>';
	echo '</body>';
	echo '</div>';
}
?>
</html>


