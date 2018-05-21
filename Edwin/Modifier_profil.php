<?php 
session_start();
require '../vendor/autoload.php';
// on teste si le visiteur a soumis le formulaire
if (isset($_POST['modifier_profil']) && $_POST['modifier_profil'] == 'Modifier') {
	// on teste l'existence de nos variables. On teste également si elles ne sont pas vides
	if ((isset($_POST['new_password']) && !empty($_POST['new_password'])) && (isset($_POST['new_pass_confirm']) && !empty($_POST['new_pass_confirm']))) {
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
	catch(Execption $e){
		die('Erreur : '.$e->getMessage());
	}

		$userManager = new User\userManager();

		if ($result[0] == $_POST['old_password']) {
			$user = new User\User();
			if(!isset($_POST['new_password'])){
				$user->setPassword($_POST['old_password']);
			}
			else{
				$user->setPassword($_POST['new_password']);
			}
			$user->setLastname($_POST['lastname'])
				->setFirstname($_POST['firstname'])
				->setBirthday($_POST['bday']);
			
			$userManager->update($user);
		header('Location: profil.php');
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
?>

<html>
<head>
<title>Modification du profil de <?php $_SESSION['login'] ?></title>
</head>
<h1> </h1>
<body>
Modification des informations<br/>
<form action="modifier_profil.php" method="post">
<span class="formulaire">Ancien mot de passe : <input type="password" name="old_password"/><br/></span>
<span class="formulaire">Nouveau mot de passe : <input type="password" name="new_password"/><br/></span>
<span class="formulaire">Confirmation du nouveau mot de passe : <input type="password" name="new_pass_confirm"/><br/> </span>
<span class="formulaire">Nom : <input type="text" name="lastname"/><br/> </span>
<span class="formulaire">Prenom : <input type="text" name="firstname"/><br/> </span>
<span class="formulaire">Date de naissance : <input type="date(Y-m-d)" name="bday"/> <br/> </span>
<input type="submit" name="modifier_profil" value="Modifier">
</form>
<?php
if (isset($erreur)) echo '<br />',$erreur;
?>
</body>
</html>



