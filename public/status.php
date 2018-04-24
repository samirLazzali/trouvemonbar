<?php
include('../src/login/login.php'); // Includes Login Script

    if(isset($_SESSION['login_user'])){
	header("location: profile.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
	<title>Login Form in PHP with Session</title>
	<link href="http://skutnik.iiens.net/github_like.css" rel="stylesheet" type="text/css">
    </head>
    <body>
    </body>
</html>
