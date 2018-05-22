<?php

if(!empty($_POST['btnDelete'])){
	$app->deleteUser($user->user_id);
	unset($_SESSION['user_id']);
	unset($_SESSION['role']);
	header("Location: index.php");

}

?>
