<?php

$change_error_message_username = '';
$changed_username = false;

if(isset($_POST['saveAllChange'])){
	$newUser = trim($_POST['newUsername']);
	if($newUser == ''){
		$change_error_message_username = "Nom d'utilisateur invalide";
	}
	else if ($app->isUsername($newUser)){
		$change_error_message_username = "Nom d'utilisateur déjà pris";
	}
	else{
		$user_id = $user->user_id;
		$app->changeField("username", $newUser, $user_id);
        header("refresh:2;");
		$changed_username = true;
	}
}
?>