<?php
require '../vendor/autoload.php';
require_once 'Modele.php';
// on teste si le visiteur a soumis le formulaire de connexion
if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') {
    if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['password']) && !empty($_POST['password']))) {
        //postgres
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    try {
        $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    }
    catch(Execption $e){
        die('Erreur : '.$e->getMessage());
    }


    // on teste si une entrée de la base contient ce couple login / pass
    $sql = $connection->prepare('SELECT count(*) as nb FROM "user" WHERE login=\''.$_POST['login'].'\' AND password=\''.$_POST['password'].'\';');
    $sql->execute();
    $data = $sql->fetch(PDO::FETCH_OBJ);

    // si on obtient une réponse, alors l'utilisateur est un membre
    if ($data->nb == 1) {
        $userManager = new User\UserManager($connection);
        $user = loginUser($_POST['login']);

        $userManager->add($user);
        session_start();
        config($user->getLogin(),$user->getLastname(),$user->getFirstname(),$user->getId(),$user->getAdministrateur());
        header('Location: accueil.php');
        exit();
    }
    // si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login, soit dans son mot de passe
    elseif ($data->nb == 0) {
        $erreur = 'Connexion impossible couple (login,password) mauvais';
    }
    // sinon, alors la, il y a un autre problème
    else {
        $erreur = 'Probème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion.';
    }
    }
    else {
    $erreur = 'Au moins un des champs est vide.';
    }
}
?>
<html>
    <head>
        <link rel="stylesheet" href="CSS/style.css">
        <title>Accueil</title>
    </head>

    <body>
        Connexion à l'espace membre :<br />
        <form action="connexion.php" method="post">
        Login : <input type="text" name="login"/><br />
        Mot de passe : <input type="password" name="password"/><br />
        <input type="submit" name="connexion" value="Connexion">
        </form>
        <a href="inscription.php">Vous inscrire !!!!!!!</a>
        <?php
        if (isset($erreur)) echo '<br /><br />',$erreur;
        ?>
    </body>
</html>