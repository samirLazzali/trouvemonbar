<?php
require '../src/accessdb.php';

function capitalise($name) {
    return (preg_replace_callback('/([.!?])\s*(\w)/', function ($matches) {
	return strtoupper($matches[1] . ' ' . $matches[2]);
    }, ucfirst(strtolower($name))));
}

function getUsername($email) {
    list($data, $domain) = explode("@", $email);
    if ($domain == "ensiie.fr" && strpos($data, '.') !== false) {
	list($name, $surname) = explode(".", $data);
	$name = capitalise($name);
	$surname = capitalise($surname);
	return "$name $surname";
    } else {
	return -1;
    }
}

session_start(); // Starting Session
$error=''; // Variable To Store Error Message

function login() {
        if (empty($_POST['email']) || empty($_POST['password'])) {
	   return "Username or Password is invalid";
        } else {
	    // Define $username and $password
	    $email=$_POST['email'];
	    $password=md5($_POST['password']);
    
	    if (lookUp($email, $password) != -1) {
    	        return "Logged in";
    	    } else {
    	        return "Invalid credentials: '$email', '$password'";
    	    }
        }
    }

function create() {
    if (empty($_POST['email']) || empty($_POST['password'])) {
	return "Empty fields";
    }
    
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $username = getUsername($email);

    if ($username == -1) {
	return "Invalid Email";
    }
    
    $connection = dbConnect();
    
    $rows = dbQuery($connection, "SELECT * FROM users WHERE email='$email';");
    
    foreach($rows as $entry) {
	return "Email already registered";
    }
    
    if (isset($_POST['username']) && $_POST['username'] != '') {
	$username = $_POST['username'];
	$rows = dbQuery($connection, "SELECT * FROM users WHERE username='$username';");
    
	foreach($rows as $entry) {
	    return "Username already taken";
	}
    }
    
    if (dbExec($connection, "INSERT INTO users (email, username, password) VALUES ('$email','$username','$password');")) {
	return "Account created";
    } else {
	return "PDO error";
    }
}

if (isset($_POST['login'])) {
    $error = login();
}

if (isset($_POST['signup'])) {
    $error = create();
}

?>
