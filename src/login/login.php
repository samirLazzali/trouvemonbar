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
    if (session_status() == PHP_SESSION_NONE) {
	session_start();
    }

    if (isset($_GET['logout'])) {
	session_destroy();
	header("Refresh:0; url=main.php");
    } else {
	if (empty($_POST['email']) || empty($_POST['password'])) {
	    return "Username or Password is invalid";
	} else {
	    // Define $username and $password
	    $email=$_POST['email'];
	    $password=md5($_POST['password']);

	    if (($row = lookUp($email, $password)) != null) {
		$_SESSION['email'] = $row->email;
		$_SESSION['username'] = $row->username;
	    } else {
		return "Invalid credentials: '$email', '$password'";
	    }
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

function buttonLogin() {
    //echo "<button class=\"button button-block\" id=\"connect\">Connect</button>";
    echo "<a class=\"m-link\" id=\"connect\"><i class=\"fa\" aria-hidden=\"true\"></i> Log In</a>";
}

function buttonLogout() {
   // print "<form align=\"right\" name=\"form1\" method=\"post\" action=\"\">";
   // print "<input name=\"logout\" type=\"submit\" id=\"logout\" value=\"log out\">";
   // print "</form>";
    echo "<a href=\"main.php?logout\" class=\"m-link\" id=\"logout\"><i class=\"fa\" aria-hidden=\"true\"></i> Log Out</a>";
}

function displayLogin() {
    echo "<div id=\"form\" class=\"form\" style=\"display: none\">";
    echo "<ul class=\"tab-group\">";
    echo "<li class=\"tab active\">";
    echo "<a href=\"#login\">Log In</a>";
    echo "</li>";
    echo "<li class=\"tab\">";
    echo "<a href=\"#signup\">Sign Up</a>";
    echo "</li>";
    echo "</ul>";
    echo "<div class=\"tab-content\">";
    echo "<div id=\"login\">";
    echo "<h1>Welcome Back!</h1>";
    echo "<!-- <form action=\"status.php\" method=\"post\"> -->";
    echo "<form action=\"main.php\" method=\"post\">";
    echo "<div class=\"field-wrap\">";
    echo "<label>Email Address<span class=\"req\">*</span></label>";
    echo "<input type=\"email\" name=\"email\" required=\"\" autocomplete=\"off\">";
    echo "</div>";
    echo "<div class=\"field-wrap\">";
    echo "<label>Password<span class=\"req\">*</span></label>";
    echo "<input type=\"password\" name=\"password\" required=\"\" autocomplete=\"off\">";
    echo "</div>";
    echo "<p class=\"forgot\"><a href=\"#\">Forgot Password?</a></p><span class=\"errorDisp\"><?php echo \"Error: \$error\"; ?></span> <button class=\"button button-block\" name=\"login\">Log In</button>";
    echo "<!-- <input name=\"submit\" type=\"submit\" value=\" Log In\"> -->";
    echo "</form>";
    echo "</div>";
    echo "<div id=\"signup\">";
    echo "<h1>Sign Up for Free</h1>";
    echo "<form action=\"main.php\" method=\"post\">";
    echo "<div class=\"field-wrap\">";
    echo "<label>Email Address<span class=\"req\">*</span></label>";
    echo "<input type=\"email\" name=\"email\" required=\"\" autocomplete=\"off\">";
    echo "</div>";
    echo "<div class=\"field-wrap\">";
    echo "<label>Username</label> <input type=\"text\" name=\"username\" autocomplete=\"off\">";
    echo "</div>";
    echo "<div class=\"field-wrap\">";
    echo "<label>Set A Password<span class=\"req\">*</span></label>";
    echo "<input type=\"password\" name=\"password\" required=\"\" autocomplete=\"off\">";
    echo "</div><span class=\"errorDisp\"><?php echo \"Error: \$error\"; ?></span>";
    echo "<button type=\"signup\" class=\"button button-block\" name=\"signup\">Get Started</button>";
    echo "</form>";
    echo "</div>";
    echo "</div><!-- tab-content -->";
    echo "</div><!-- /form -->";

    echo "<script src=\"js/login.js\"></script>";
}
?>
