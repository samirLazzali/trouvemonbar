<?php
    require_once("../../config.php");
    require_once("User.php");

    $requestedId = null;
    $requestedUsername = null;

    if (isset($_GET['id']))
    {
        $requestedId = $_GET['id'];
        $u = User::fromId($requestedId);

        if ($u == null)
            error_die("No such user.");
        else
            success_die($u);
    }
    elseif (isset($_GET['username']))
    {
        $requestedUsername = $_GET['username'];
        $u = User::fromUsername($requestedUsername);

        if ($u == null)
            error_die("No such user.");
        else
            success_die($u);
    }
    else
        error_die("One parameter among 'ID' and 'Username' has to be given.");
