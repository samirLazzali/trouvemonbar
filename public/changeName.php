<?php

$change_error_message_name = '';
$changed_name = false;

if(isset($_POST['newName'])){
	$newName = trim($_POST['newName']);
	if($newName == ''){
		$change_error_message_name = "Nom invalide";
	}
	else{
		$user_id = $user->user_id;
		$app->changeField("name", $newName, $user_id);
        header("refresh:2;");
		$changed_name = true;
	}
}

?>
