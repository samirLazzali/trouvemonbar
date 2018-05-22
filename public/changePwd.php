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

$changed = false;
$change_error_message = '';


if(!empty($_POST['btnChangePassword'])){
	$change_error_message = '';
	$changed = false;

	$newPassword = $_POST['newPassword'];
	$newPasswordConfirmation = $_POST['newPasswordConfirmation'];
	if($newPassword == ''){
		$change_error_message = "Mot de passe invalide";
	}
	else if ($newPassword == $newPasswordConfirmation){
		$user_id = $user->user_id;
		$app->changeField("password", $newPassword, $user_id);
		$changed = true;
	}
	else{
		$change_error_message = "Les mots de passes saisis ne coïncident pas";
	}
}

?>

	<!DOCTYPE HTML>
		<html lang="fr">

		<head>
			<meta charset="UTF-8">
			<title>Modifier</title>
			<!-- Latest compiled and minified CSS -->
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

		</head>

		<body>
			<div class="col-md-5 container">
				<div class="well">
					<h2>
						Changer de mot de passe
					</h2>
					<?php
					if($changed == true){
						echo "<div class='alert alert-success'>Mot de passe changé avec succès"
						. "</div>";
					}
					else if($change_error_message!= ""){
						echo "<div class='alert alert-danger'>Erreur : " . $change_error_message
						. "</div>";
					}
					?>
					<p>
						<form action="changePwd.php" method="POST">
							<input style="display:none"> <!-- to hide autocompletion -->
							<input type="password" style="display:none">

							<div class="form-group">
								<label for="">Nouveau mot de passe</label>
								<input type="password" name="newPassword" class="form-control" value=""/>
							</div>
							<div class="form-group">
								<label for="">Confirmez le nouveau mot de passe</label>
								<input type="password" name="newPasswordConfirmation" class="form-control" value=""/>
							</div>
							<div class="form-group">
								<input type="submit" name="btnChangePassword" class="btn btn-primary" value="Valider" />
								<a href="changeSettings.php" class="btn btn-secondary">Retour</a>

							</div>
						</form>
					</p>
				</div>
			</div>
		</body>

		</html>