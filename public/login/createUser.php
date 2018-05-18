<?php
require '../src/accessdb.php';

if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
	$error = "Empty fields";
	return -1;
    }

    $email=$_POST['email'];
    $password=md5($_POST['password']);

    $connection = dbConnect();

    $rows = dbQuery($connection, "SELECT * FROM users WHERE email='$email';");

    foreach($rows as $entry) {
	$error = "Email already registered";
	return -1;
    }

    if (isset($_POST['username'])) {
	$username = $_POST['username'];
	$rows = dbQuery($connection, "SELECT * FROM users WHERE username='$username';");

	foreach($rows as $entry) {
	    $error = "Username already taken";
	    return -1;
	}
    }

    dbQuery($connection, "INSERT INTO users (email, username, passowrd) VALUES ('$email','$username','$password');");
}
