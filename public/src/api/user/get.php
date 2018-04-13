<?php
    require_once("../../config.php");
    require_once("User.php");

    $requestedId = null;
    $requestedUsername = null;

    if (isset($_GET['id']))
    {
        $requestedId = $_GET['id'];

        try {
            $u = User::fromId($requestedId);
            success_die($u);
        }
        catch (UserNotFoundException $e) {
            error_die($e->getMessage());
        }
    }
    elseif (isset($_GET['username']))
    {
        $requestedUsername = $_GET['username'];
        $u = User::fromUsername($requestedUsername);

        try
        {
            $u = User::fromUsername($requestedUsername);
            success_die($u);
        }
        catch (UserNotFoundException $e) {
            error_die($e->getMessage());
        }
    }
    else
        error_die("One GET parameter among 'ID' and 'Username' has to be given.");
