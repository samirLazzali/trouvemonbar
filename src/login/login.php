<?php

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

function lookUp($connection, $email, $md5Pass) {
    $rows = $connection->query("SELECT * FROM users WHERE email='$email' AND password='$md5Pass'")->fetchAll(\PDO::FETCH_OBJ);

    foreach ($rows as $entry) {
	return $entry->id;
    }

    return -1;
}

    session_start(); // Starting Session
    $error=''; // Variable To Store Error Message

    if (isset($_POST['submit'])) {

	if (empty($_POST['email']) || empty($_POST['password'])) {
	    $error = "Username or Password is invalid";
	} else {
	    // Define $username and $password
	    $email=$_POST['email'];
	    $password=md5($_POST['password']);

	    if (lookUp($connection, $email, $password) != -1) {
		echo "Logged in";
	    } else {
		echo "Invalid credentials: '$email', '$password'";
	    }
	}

    }
?>
