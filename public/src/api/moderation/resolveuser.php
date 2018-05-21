<?php

require_once("../../config.php");

$u = verify_logged_in();
if (!$u->getModerator())
    error_die("Current user doesn't have sufficient rights.", ERROR_Permissions);

if (isset($_GET['user']))
    $userId = $_GET['user'];
else
    error_die("user", ERROR_FieldMissing);

if (isset($_GET['deactivate'])) {
    $deactivateUser = $_GET['deactivate'];
    if (strtolower($deactivateUser) == "true")
        $deactivateUser = true;
    elseif (strtolower($deactivateUser) == "false")
        $deactivateUser = false;
    else
        error_die("deactivate should be true or false.", STATUS_ERROR);
}
else
    error_die("deactivate", ERROR_FieldMissing);

try
{
    $u = User::findWithIDorUsername($userId);
}
catch (UserNotFoundException $e)
{
    error_die("User not found.", ERROR_NotFound);
}

$resolved = UserReport::resolveAll($u);

if ($deactivateUser)
    $u->deactivate();

success_die("$resolved reports resolved.");