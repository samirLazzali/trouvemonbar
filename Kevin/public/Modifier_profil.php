<?php
session_start();
require '../vendor/autoload.php';
require_once 'Vue.php';
require_once 'Modele.php';

$userManager = new User\UserManager($connection);

// on teste si le visiteur a soumis le formulaire
if (isset($_POST['modifier_profil']) && $_POST['modifier_profil'] == 'Modifier') {
    // on teste l'existence de nos variables. On teste également si elles ne sont pas vides
    if ((isset($_POST['new_password']) /*&& !empty($_POST['new_password'])*/) && (isset($_POST['new_pass_confirm']) /*&& !empty($_POST['new_pass_confirm'])*/)) {
        // on teste les deux mots de passe
        if ($_POST['new_password'] != $_POST['new_pass_confirm']) {
            $erreur = 'Les 2 mots de passe sont différents.';
        }
        else {
            //postgres
            $dbName = getenv('DB_NAME');
            $dbUser = getenv('DB_USER');
            $dbPassword = getenv('DB_PASSWORD');
            try {
                $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
            }
            catch(Exception $e){
                die('Erreur : '.$e->getMessage());
            }

            // on regarde si le mot de passe correspond bien au mot de passe de l'utilisateur connecté
            $sql = $connection->prepare('SELECT password FROM "user" WHERE login=\''.$_SESSION['login'].'\';');
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_OBJ);


            if ($result->password == $_POST['old_password']) {
                $user = new \User\User();
                if (empty($_POST['new_password'])){
                    $user->setPassword($_POST['old_password']);
                }
                else{
                    $user->setPassword($_POST['new_password']);
                }
                if (empty($_POST['lastname'])){
                    $user->setLastname($_SESSION['nom']);
                }
                else{
                    $user->setLastname($_POST['lastname']);
                }
                $user->setFirstname($_POST['firstname'])
                   // ->setLastname($_POST['lastname'])
                    ->setBirthday(new \DateTime($_POST['bday']))
                    ->setId($_SESSION['id']);

                $userManager->update($user);
                $log = $_SESSION['login'];
                $i = $_SESSION['id'];
                config($log,$_POST['lastname'], $_POST['firstname'], $_SESSION['id'], 'false');
                header('Location: profil.php?pseudo='.$log.'&id='.$i.'');
                exit();
            }
            else {
                $erreur = 'Formulaire invalide';
            }
        }
    }
    else {
        $erreur = 'Au moins un des champs est vide.';
    }

}

$moi = $userManager->get($_SESSION['id']);


afficheMenu();
enTete("Modification du profil de php ".$_SESSION['login'], "CSS/style.css");
titreH1("Modification des informations");
?>

<div class="conteneur">

    <form action="modifier_profil.php" method="post" class="inscription">
        <span class="formulaire">Ancien mot de passe : <input type="password" name="old_password"/><br/></span>
        <span class="formulaire">Nouveau mot de passe : <input type="password" name="new_password"/><br/></span>
        <span class="formulaire">Confirmation du nouveau mot de passe : <input type="password" name="new_pass_confirm"/><br/> </span>
        <span class="formulaire">Nom : <input type="text" name="lastname" value="<?php echo $moi->getLastname(); ?>"/><br/> </span>
        <span class="formulaire">Prenom : <input type="text" name="firstname" value="<?php echo $moi->getFirstname(); ?>"/><br/> </span>
        <span class="formulaire">Date de naissance : <input type="date(Y-m-d)" name="bday" value="<?php echo date_format($moi->getBirthday(),"Y-m-d"); ?>"> <br/> </span>
        <input type="submit" name="modifier_profil" value="Modifier" class="styleButton">
    </form>

</div>
<?php
if (isset($erreur)) echo '<br />',$erreur;

pied();
?>



