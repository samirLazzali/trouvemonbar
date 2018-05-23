<?php
session_start();

$username = "admin";
$pwd = "ensiie";

if(isset($_POST['username']) && isset($_POST['password']) && 
	$_POST['username']==$username && $_POST['password']==$pwd) {

	$_SESSION['connected'] = true;
	header('Location: home.php');

}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="style.css">
		<title></title>
	</head>
	<body>
		<div class="login-page">
		  <div class="form">
		    <form class="login-form" action="" method="post">
		      <input type="text" placeholder="username" name="username" />
		      <input type="password" placeholder="password" name="password"/>
		      <input type="submit" name="submit" value="login"/>
		    </form>
		  </div>
		</div>
	</body>
</html>