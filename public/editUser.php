<?php
include("../src/accessdb.php");

session_start();

$id = $_POST['id'];
$username = $_POST['username'];
$email = $_POST['email'];
$pass = md5($_POST['p1']);

if ($_POST['p1'] == $_POST['p2']) {
    $connection = dbConnect();
    dbExec($connection, "DELETE FROM users WHERE id=$id;");
    dbExec($connection, "INSERT INTO users VALUES (" . $connection->quote($id) . ", " . $connection->quote($email) . ", " . $connection->quote($username) . ", " . $connection->quote($pass) . ", 'FALSE');");
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
}

$_POST = array();
header("Refresh:0; url=perso.php");

?>
