<?php 
session_start();
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

		// on regarde si le mot de passe correspond bien au mot de passe de l'utilisateur connecté
		$sql = $connection->prepare('SELECT password FROM user WHERE login=?');
		$sql->execute(array($_SESSION['login']));
    	$result = $sql->fetch(PDO::FETCH_OBJ);
		

		if ($result[0] == $_POST['old_password']) {
			$user = new \User\User();
			$user->setPassword($_POST['new_password']);
			if(isset($_POST['lastname']) && !empty($_POST['lastname'])){
				$user->setLastname($_POST['lastname']);
			}
			if(isset($_POST['firstname']) && !empty($_POST['fisrtname']))
			{
				$user->setFirstname($_POST['firstname']);
			}
			if(isset($_POST['bday']) && !empty($_POST['bday']))
			{
				$user->setBirthday($_POST['bday']);
			}

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



