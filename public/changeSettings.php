<?php
require __DIR__ . '/library.php';
// Start Session
session_start();

// check user login
if(empty($_SESSION['user_id']))
{
	header("Location: index.php");
}


$app = new Library();

$user = $app->UserDetails($_SESSION['user_id']); // get user details

$choix = "";

if(!empty($_POST['btnChange'])){
	$choix = $_POST['change'];
	if($choix == "Name"){
		header("Location: changeName.php");
	}
	else if($choix == "Username"){
		header("Location: changeUsername.php");
	}
	else if($choix == "Email"){
		header("Location: changeEmail.php");
	}
	else if($choix == "Password"){
		header("Location: changePwd.php");
	}
	else if($choix == "Delete"){
		header("Location: delAccount.php");
	}
}

?>

	<!DOCTYPE HTML>
	<html lang="fr">

	<head>
		<meta charset="UTF-8">
		<title>Paramètres</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

	</head>

	<body>
		<div class="container">
			<div class="col-md-5 container">
				<h2>
					Paramètres
				</h2>
				<h4><?php echo $user->name ?>, que voulez vous faire ?</h4>
				<form action="changeSettings.php" method="POST">
					<input type="radio" value="Name" name="change"/>Changer votre nom<br/>
					<input type="radio" value="Username" name="change"/>Changer le nom d'utilisateur<br/>
					<input type="radio" value="Email" name="change"/>Changer l'e-mail associé au compte<br/>
					<input type="radio" value="Password" name="change"/>Changer de mot de passe<br/>
					<input type="radio" value="Delete" name="change"/>Supprimer votre compte<br/>
					<br/>
					<input type="submit" name="btnChange" class="btn btn-primary" value="Valider" />
					<a href="profile.php" class="btn btn-secondary">Retour</a><br/>
                </form>
			</div>
		</div>
	</body>

	</html>