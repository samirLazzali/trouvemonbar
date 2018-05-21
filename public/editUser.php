<?php
include("../src/accessdb.php");
include("../src/user.php");

session_start();

$id = $_POST['id'];
$username = $_POST['username'];
$email = $_POST['email'];
$pass = md5($_POST['p1']);

$privileges = (User::isAdmin($id) || isset($_POST['makeAdmin']));

if ($_POST['p1'] == $_POST['p2']) {
    $connection = dbConnect();

    $query = "UPDATE users SET email = " . $connection->quote($email) . ", username = " . $connection->quote($username);

    if ($_POST['p1'] != "")
	$query = $query . ", password = " . $connection->quote($pass);

    if ($privileges)
	$query = $query . ", admin = " . $connection->quote($privileges);

    $query = $query . " WHERE id=$id;";

    dbExec($connection, $query);

    if ($_SESSION['id'] == $_POST['id']) {
	$_SESSION['username'] = $username;
	$_SESSION['email'] = $email;
    }
}

$_POST = array();
header("Refresh:0; url=perso.php?edit=$id");

?>
