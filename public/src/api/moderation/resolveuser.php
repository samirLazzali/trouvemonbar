<?php

require_once("../../config.php");

$u = verify_logged_in();
if (!$u->getModerator())
    error_die("Current user doesn't have sufficient rights.", ERROR_Permissions);

if (isset($_GET['user']))
    $userId = $_GET['user'];
else
    error_die("post", ERROR_FieldMissing);

if (isset($_GET['delete'])) {
    $deleteUser = $_GET['delete'];
    if (strtolower($deleteUser) == "true")
        $deleteUser = true;
    elseif (strtolower($deleteUser) == "false")
        $deleteUser = false;
    else
        error_die("delete should be true or false.", STATUS_ERROR);
}
else
    error_die("delete", ERROR_FieldMissing);

try
{
    $u = User::findWithIDorUsername($userId);
}
catch (UserNotFoundException $e)
{
    error_die("User not found.", ERROR_NotFound);
}

$resolved = UserReport::resolveAll($p);

if ($deleteUser)
    $u->delete();

success_die("$resolved reports resolved.");