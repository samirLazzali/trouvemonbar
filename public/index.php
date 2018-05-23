<?php
session_start();

require '../vendor/autoload.php';
require_once 'Modele.php';
require_once 'Vue.php';

if (isset($_SESSION['id'])){
    header("Location: accueil.php");
}

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");



// on teste si le visiteur a soumis le formulaire de connexion
if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') {
    if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['password']) && !empty($_POST['password']))) {

    

    // on teste si une entrée de la base contient ce couple login / pass
    $sql = $connection->prepare('SELECT count(*) as nb FROM "user" WHERE login=\''.$_POST['login'].'\' AND password=\''.$_POST['password'].'\';');
    $sql->execute();
    $data = $sql->fetch(PDO::FETCH_OBJ);


    // si on obtient une réponse, alors l'utilisateur est un membre
    if ($data->nb ==1) {
        $idUser = idUserLogin($_POST['login']);
        $userManager = new User\UserManager($connection);
        $user = $userManager->get($idUser);

        config($_POST['login'],nom_user($idUser), prenom_user($idUser), $idUser, $user->getAdministrateur());

        header('Location: accueil.php');
        //exit();
    }
    // si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login, soit dans son mot de passe
    elseif ($data->nb == 0) {
        $erreur = 'Compte non reconnu.';
    }
    // sinon, alors la, il y a un autre problème
    else {
        $erreur = 'Problème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion.';
    }
    }
    else {
        $erreur = 'Au moins un des champs est vide.';
    }
}

enTeteConnexion("Connexion à l'espace membre","CSS/style.css");
echo '<div class="conteneur">';
?>


<form action="index.php" method="post" class="inscription">
Login : <input type="text" name="login"/><br />
Mot de passe : <input type="password" name="password"/><br />
<input type="submit" name="connexion" value="Connexion" class="styleButton">
<?php
if (isset($erreur)) echo '<br /><br />',$erreur;
?>
<br /><br />
    <a href="inscription.php" class="styleButton">Vous inscrire</a>

</form>

</div>

<?php
pied()
?>