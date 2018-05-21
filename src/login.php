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

function login() {
    if (empty($_POST['email']) || empty($_POST['password'])) {
	return "Username or Password is invalid";
    } else {
	// Define $username and $password
	$email=$_POST['email'];
	$password=md5($_POST['password']);

	if (($row = lookUp($email, $password)) != null) {
	    $_SESSION['id'] = $row->id;
	    $_SESSION['email'] = $row->email;
	    $_SESSION['username'] = $row->username;
	    $_SESSION['admin'] = $row->admin;
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

function verif_authent() {
    return isset($_SESSION['email']);
}

function protectAccess($adminOnly = false) {
    session_start();
    if (!isset($_SESSION['username'])) {
	header("Refresh:0; url=nondroit.php");
	exit();
    }
    
    if ($adminOnly && !$_SESSION['admin']) {
	header("Refresh:0; url=nondroit.php");
	exit();
    }
}

function buttonLogin() {
    echo "<a class=\"m-link\" id=\"connect\"><i class=\"fas fa-sign-in-alt\" aria-hidden=\"true\"></i> Se connecter</a>";
}

function buttonLogout() {
    echo "<a href=\"main.php?logout\" class=\"m-link\" id=\"logout\"><i class=\"fas fa-times-circle\"></i> Se déconnecter</a>";
}

function displayLogin() {
    include("modules/login.html");
}

function handleLogin() {
    session_start();

    if (isset($_GET['logout'])) {
	session_destroy();
	header("Refresh:0; url=main.php");
	exit();
    }

    if (isset($_GET['login'])) {
	login();
    }

    if (isset($_GET['create'])) {
	create();
    }
}
?>
