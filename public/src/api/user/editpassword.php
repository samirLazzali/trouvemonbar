<?php

require_once("../../config.php");

$u = verify_logged_in();

if (isset($_POST['newpassword']))
    $newPassword = $_POST['newpassword'];
else
    error_die("newpasword", ERROR_FieldMissing);

if (isset($_POST['password']))
    $currentPassword = $_POST['password'];
else
    error_die("password", ERROR_FieldMissing);

if (!User::testPassword($u->getID(), $currentPassword))
    error_die("Wrong password.", ERROR_WrongPassword);

$u->updatePassword($newPassword);
authenticate($u);
success_die("Password updated.");