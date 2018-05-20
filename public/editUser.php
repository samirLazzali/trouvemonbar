<?php
include("../src/accessdb.php");

session_start();

$id = $_POST['id'];
$username = $_POST['username'];
$email = $_POST['email'];
$pass = md5($_POST['p1']);

if ($_POST['p1'] == $_POST['p2']) {
    $connection = dbConnect();
    dbExec($connection, "UPDATE users SET email = " . $connection->quote($email) . ", username = " . $connection->quote($username) . ", password = " . $connection->quote($pass) . ", admin = 'FALSE' WHERE id=$id;");

    //print "UPDATE users SET email = " . $connection->quote($email) . ", username = " . $connection->quote($username) . ", password = " . $connection->quote($pass) . ", admin = 'FALSE' WHERE id=$id;";
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
}

$_POST = array();
header("Refresh:0; url=perso.php");

?>
