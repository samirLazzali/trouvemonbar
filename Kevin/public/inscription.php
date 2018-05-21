<?php
require '../vendor/autoload.php';
require_once 'Modele.php';
require_once 'Vue.php';




// on teste si le visiteur a soumis le formulaire
if (isset($_POST['inscription']) && $_POST['inscription'] == 'Inscription') {
	// on teste l'existence de nos variables. On teste également si elles ne sont pas vides
	if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['password']) && !empty($_POST['password'])) && (isset($_POST['pass_confirm']) && !empty($_POST['pass_confirm']))) {
	// on teste les deux mots de passe
	if ($_POST['password'] != $_POST['pass_confirm']) {
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

		// on recherche si ce login est déjà utilisé par un autre membre
		$sql = $connection->prepare('SELECT count(*) as nb FROM "user" WHERE login=?');
		$sql->execute(array($_POST['login']));
    	$result = $sql->fetch(PDO::FETCH_OBJ);

    	if ($result->nb == 0) {

    		$userManager = new User\UserManager($connection);
			$user = new User\User();
			$user->setLogin($_POST['login'])
				->setFirstname($_POST['firstname'])
				->setLastname($_POST['lastname'])
				->setBirthday(new \DateTime($_POST['bday']))
                ->setPassword($_POST['password'])
				->setAdministrateur("false");

			$userManager->add($user);
			

			session_start();
       		config($user->getLogin(),$user->getLastname(),$user->getFirstname(),idUserLogin($user->getLogin()),$user->getAdministrateur());
			header('Location: accueil.php');
			exit();
    	}
		else {
		$erreur = 'Un membre possède déjà ce login.';
		}
	}
	}
	else {
	$erreur = 'Au moins un des champs est vide.';
	}
}

enTeteConnexion("Inscription à l'espace membre :","CSS/style.css");

?>

<div class="conteneur">

<form action="inscription.php" method="post" class="inscription">
<span class="formulaire"> Login : <input type="text" name="login"/><br/> </span>
<span class="formulaire">Mot de passe : <input type="password" name="password"/><br/></span>
<span class="formulaire">Confirmation du mot de passe : <input type="password" name="pass_confirm"/><br/> </span>
<span class="formulaire">Nom : <input type="text" name="lastname"/><br/> </span>
<span class="formulaire">Prenom : <input type="text" name="firstname"/><br/> </span>
<span class="formulaire">Date de naissance : <input type="date(Y-m-d)" name="bday"/> <br/> </span>
<input type="submit" name="inscription" value="Inscription" class="styleButton">
</form>

</div>

<?php
if (isset($erreur)) echo '<br />',$erreur;

pied();
?>
