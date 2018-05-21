<?php
require '../vendor/autoload.php';
require_once 'Modele.php';
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
	catch(Execption $e){
		die('Erreur : '.$e->getMessage());
	}

		// on recherche si ce login est déjà utilisé par un autre membre
		$sql = $connection->prepare('SELECT count(*) as nb FROM "user" WHERE login=?');
		$sql->execute(array($_POST['login']));
    	$result = $sql->fetch(\PDO::FETCH_OBJ);
		

		if ($result->nb == 0) {
			$userManager = new User\userManager($connection);
			$user = new User\User();
			$user->setLogin($_POST['login'])
				->setFirstname($_POST['firstname'])
				->setLastname($_POST['lastname'])
				->setBirthday(new \Datetime($_POST['bday']))
				->setPassword($_POST['password'])
				->setAdministrateur(false);

			$userManager->add($user);
		session_start();
		   $user = loginUser($_POST['login']);
        config($user->getLogin(),$user->getLastname(),$user->getFirstname(),$user->getId(),$user->getAdministrateur());
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
?>

<html>
	<head>
		<link rel="stylesheet" href="CSS/style.css">
		<title>Inscription</title>
	</head>
		
	<body>
		<h1>BIENVENU SUR TWITIIE </h1>
		<p id="titre">Inscription à l'espace membre :</p>
		<form action="inscription.php" method="post">
		<p>Login : <input type="text" name="login"/><br/> 
		Mot de passe : <input type="password" name="password"/><br/>
		Confirmation du mot de passe : <input type="password" name="pass_confirm"/><br/> 
		Nom : <input type="text" name="lastname"/><br/> 
		Prenom : <input type="text" name="firstname"/><br/>
		Date de naissance : <input type="date(Y-m-d)" name="bday"/> <br/> </p>
		<input type="submit" name="inscription" value="Inscription">
		</form>
		<?php
		if (isset($erreur)) echo '<br />',$erreur;
		?>
	</body>
</html>
