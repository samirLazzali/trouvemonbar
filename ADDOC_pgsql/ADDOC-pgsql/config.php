<?php
session_start();

$host_name = "localhost";
$user_name = "root";
$datb_name = "addhoc";
$password  = "";

$root_adress = "https://delophontnoah.000webhostapp.com/";
$address_from_root = "/";

$id = 0;

$lang = 'en';

if( (basename($_SERVER['PHP_SELF'])=='index.php') && isset($_SESSION['id']) && isset($_SESSION['firstname']) && isset($_SESSION['lastname']) && isset($_SESSION['date_signedup']) && isset($_SESSION['email']) ) {
	header("Location: ".$root_adress."home.php");
}


if(	((basename($_SERVER['PHP_SELF'])!='index.php') && (basename($_SERVER['PHP_SELF'])!='deposit.php') && (!isset($_SESSION['id']) || !isset($_SESSION['firstname']) || !isset($_SESSION['lastname']) || !isset($_SESSION['date_signedup']) || !isset($_SESSION['email']))) ||
	((basename($_SERVER['PHP_SELF'])=='index.php') && !isset($_POST['url']) && !isset($_POST['firstname']) && !isset($_POST['email_signin']) && !isset($_GET['disconnect']) && !isset($_GET['choose']) && !isset($_GET['signin']) && !isset($_GET['signup']) && !isset($_GET['account']))) {

	header("Location: ".$root_adress."index.php?choose=true");
}

function create_session_values($id,$firstname,$lastname,$email,$date_signedup) {
	$_SESSION['id'] = $id;
	$_SESSION['firstname'] = $firstname;
	$_SESSION['lastname'] = $lastname;
	$_SESSION['email'] = $email;
	$_SESSION['date_signedup'] = $date_signedup;
}

function set_cookie_user($id,$firstname,$lastname,$email,$date_signedup) {
	setcookie('id', $id, time() + 365*24*3600, null, null, false, true);
	setcookie('id', $firstname, time() + 365*24*3600, null, null, false, true);
	setcookie('id', $lastname, time() + 365*24*3600, null, null, false, true);
	setcookie('id', $email, time() + 365*24*3600, null, null, false, true);
	setcookie('id', $date_signedup, time() + 365*24*3600, null, null, false, true);
}

function disconnect() {
	session_destroy();
	set_cookie_user('','','','','');
	header("Location: ".$root_adress."index.php?choose=true");
}